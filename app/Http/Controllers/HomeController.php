<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;
require 'vendor/autoload.php';
use Mailgun\Mailgun;

class HomeController extends Controller
{
    public $error = "";
    public $auth = "";
    public function Login()
    {
        return view('home.login');
    }

    public function Pincode()
    {
        if($request->session()->has('pin')){
            return view('home.login');
        }
        else{
            return redirect()->route('home.login');
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

    public function Registration()
    {
        return view('home.registration', $error);
    }

    public function Register(Request $req)
    {
        $this->validateRegistration();
        $user = new User();
        $user->name                       = $req->username;
        $user->email                        = $req->email;
        $user->blood_group            = $req->bloodgroup;
        $user->phone_number        = $req->phone;
        $user->type                         = "User";
        $user->status                       = "Unverified";
        $user->gender                      = $req->gender;
        $user->password                 = $req->password;

        if ($user->save()) {
            $pin = rand(1000,9999);
            $req->session()->put('pin', $pin);

            $mgClient = new Mailgun('YOUR_API_KEY');
            $domain = "YOUR_DOMAIN_NAME";

            $result = $mgClient->sendMessage($domain, array(
                'from'	=> 'BetterCallDoc',
                'to'	=> $user->email,
                'subject' => 'Email verification',
                'text'	=> 'Your Pincode is: '+ $pin
            ));
            If($result){
                return redirect()->route('home.pincode');
            }else{


            }
        }
        else{
            echo "Server Error";
        }
    }  
    public function validateRegistration() { 
        return request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'blood_group' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'password' => 'required',

          ]);
        }
    public function ValidateLogin(Request $req)
    {
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
            return redirect()->route('login.login');
        }
    }

    public function Logout(Request $req){
    	$req->session()->flush();

    	return redirect()->route('home.login');
    }
}
