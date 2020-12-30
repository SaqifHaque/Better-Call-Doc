<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use \Illuminate\Foundation\Auth\AuthenticatesUsers;

class HomeController extends Controller
{
    public $error = "";
    public function Login()
    {
        return view('home.login');
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
        return view('home.registration');
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
            return redirect()->route('home.login');
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
            $req->session()->put('uname', $user->u_name);
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
