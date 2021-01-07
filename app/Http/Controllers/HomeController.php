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
                $req->session()->forget('pin');
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
            'phone_number' => 'required|min:15|max:15|unique:users',
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
        $user->phone_number        = $req->phone_number;
        $user->type                         = "Patient";
        $user->status                       = "Unverified";
        $user->gender                      = $req->gender;
        $user->password                 = $req->password;
        // dd($user)

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
    public function ValidateLogin(Request $req)
    {
        $auth = "";
        $user  = User::where('email', $req->email)
                        ->where('password', $req->password)
                        ->where('type',"!=","Patient:Facebook")
                        ->where("type","!=","Unverified")
                        ->first();
                       // dd($user);
        if($user)
        {
            $req->session()->put('id', $user->id);
            $req->session()->put('email', $user->email);
            $req->session()->put('name', $user->name);
            $req->session()->put('type', $user->type);

            $did = DB::table('doctors')->where('user_id',$user->id)->first();

            if($user->type == "Admin"){
               // dd($user);
                return redirect()->route('admin.admindash');
            }
            else if($user->type == "Doctor"){
                return redirect()->route('doctordash',[$did->id]);
            }
            else if($user->type == "Patient"){
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
        $check = DB::table('users')
        ->where('email', '=', $info->email)
        ->first();
        if ($check == null) {
            $user = new User();
            $user->name = $info->name;
            $user->blood_group = "N/A";
            $user->email = $info->email;
            $user->phone_number = "N/A";
            $user->profile_pic = $info->avatar;
            $user->type = "Patient:Facebook";
            $user->status = "Verified";
            $user->gender = "N/A";
            $user->password = "N/A";
            $user->save();
            return redirect()->route('user.userdash');
    }else {
        session()->put('email', $check->email);
        session()->put('type', $check->type);
        session()->put('name', $check->name);
        session()->put('id', $check->id);
        return redirect()->route('user.userdash');
    }
}

    public function Logout(Request $req){
    	$req->session()->flush();
    	return redirect()->route('home.login');
    }
}
