<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\Rules\Email;
require '../vendor/autoload.php';
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function Login()
    {
        $auth = "";
        return view('home.login', ["auth" => $auth]);
    }

    public function Pincode(Request $req)
    {
        if($req->session()->has('pin')){
            $msg="";
            return view('home.pincode',["msg" => $msg]);
        }
        else{
            return redirect()->route('home.login');
        }
    }
    public function CheckPin(Request $req)
    {
        if($req->pincode == $req->session()->get('pin') ){

            $user = DB::table('users')
            ->where('email',$req->session()->get('verify'))->update(['status' => "Verified"]);
            if ($user) {
                $request->session()->forget('pin');
                return redirect()->route('home.login');
            }
            $msg="Server Error";
            return view('home.pincode',["msg" => $msg]);
        }
        else{
            $msg="Invalid OTP";
            return view('home.pincode',["msg" => $msg]);
        }
    }

    public function Registration()
    {
        return view('home.registration');
    }

    public function Register(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'bloodgroup' => 'required',
            'phone' => 'required|min:15|max:15|unique:users',
            'password' => 'required|same:confirmpass',
            'confirmpass' => 'required'
        ]);
        
        if ($validator->fails()) {
            //return view('home.registration', ["ch" => $ch]);
            return redirect()->route('home.registration')->with('errors',$validator->errors())->withInput();
        }else{
        $user = new User();
        $user->name                       = $req->name;
        $user->email                        = $req->email;
        $user->blood_group            = $req->bloodgroup;
        $user->phone_number        = $req->phone;
        $user->type                         = "Patient";
        $user->status                       = "Unverified";
        $user->gender                      = $req->gender;
        $user->password                 = $req->password;

        if ($user->save()) {
            $pin = rand(1000,9999);
            $req->session()->put('pin', $pin);
            $req->session()->put('verify', $req->email);


            Mail::raw('Your Email Verification Code: '.strval($pin), function($message) use ($user)
            {
                $message->subject('Email Verification!');
                $message->from('no-reply@bettercalldoc.com', 'BetterCallDoc');
                $message->to($user->email);
            });
            return redirect()->route('home.pincode');
        }

        else{
            echo "Server Error";
        }
    }  
}
    /*public function validateRegistration() { 
        return request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'blood_group' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'password' => 'required',

          ]);
        }*/
    public function ValidateLogin(Request $req)
    {
        $auth = "";
        $user  = User::where('email', $req->email)
                        ->where('password', $req->password)
                        ->first();
        if($user)
        {
            $req->session()->put('uname', $user->name);
            $req->session()->put('type', $user->type);

            if($user->type == "Admin"){
                return redirect()->route('admin.admindash');
            }
            else if($user->type == "Doctor"){
                return redirect()->route('doctor.doctordash');
            }
            else if($user->type == "User"){
                return redirect()->route('user.userdash');
            }
        }
        else{
            $auth = "Unauthorized";
            return view('home.login', ["auth" => $auth]);
        }
    }

    public function LoadFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function FacebookResponse()
    {
        $info = Socialite::driver('facebook')->user();
        if($save){
            return view('Teacher.teacherDash');
        }else{
            return redirect()->route('user.login');
        }
        //
    }

    public function Logout(Request $req){
    	$req->session()->flush();
    	return redirect()->route('home.login');
    }
}
