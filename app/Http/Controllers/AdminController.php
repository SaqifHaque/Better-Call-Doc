<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Doctor;
use App\Finance;


class AdminController extends Controller
{

    public function admindash(){
        $user= DB::table('users')->get();
        $user = count($user);
        $app = DB::table('appoinments')->where("status","Pending")->get();
        $app = count($app);
        $tapp = DB::table('appoinments')->get();
        $tapp = count($tapp);
        $admin = DB::table('users')->where("type","Admin")->get();
        $admin = count($admin);
        $patient = DB::table('users')->where("type","Patient")->get();
        $patient = count($patient);
        $doctor = DB::table('users')->where("type","Doctor")->get();
        $doctor = count($doctor);
        $can = DB::table('appoinments')->where("status","Cancelled")->get();
        $can = count($can);
        $com = DB::table('appoinments')->where("status","Completed")->get();
        $com = count($com);
        $finance = DB::table('finances')->get();
        $rev = 0;
        foreach($finance as $f)
        {
                $rev += (int)$f->details;
        }
        $profit = ($rev*15)/100;
        $cost = $rev - $profit;


        return view('admin.admindash',compact('user','app','tapp','admin','patient','doctor','can','com','rev','profit','cost'));
    }

    public function index()
    {
        $users= User::all();
        return view('admin.user-list', compact('users'));
       
    }

    public function Finance()
    {
        $finances = DB::table('finances')->get();
        return view('admin.finance')->with('finances',$finances);
       
    }

    public function store(Request $request, User $user, Doctor $doctor)
    {
        if($request->type == "Doctor"){
            $this->validateDoctor();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->blood_group = $request->blood_group;
            $user->phone_number = $request->phone_number;
            $user->type = $request->type;
            $user->status = $request->status;
            $user->gender = $request->gender;
            $user->password = $request->password;
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/profile-picture/', $filename);
                $user->profile_pic = $filename;
            }
            $user->save();

            $doctor->user_id = $user->id;
            $doctor->specilization = $request->specilization;
            $doctor->qualification = $request->qualification;
            $doctor->availability = $request->availability;
            $doctor->time = $request->time;
            $doctor->charge = $request->charge;
            $doctor->save();

            return redirect('/admindash')->with('success', 'Doctor has been saved');
        }
        else{
            $this->validateUser();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->blood_group = $request->blood_group;
            $user->phone_number = $request->phone_number;
            $user->type = $request->type;
            $user->status = $request->status;
            $user->gender = $request->gender;
            $user->password = $request->password;
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/profile-picture/', $filename);
                $user->profile_pic = $filename;
            }
            $user->save();
            return redirect('/admindash')->with('success', 'User has been saved');
        }
    }
    public function validateDoctor()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'email|unique:users|required',
            'blood_group' => 'required',
            'phone_number' => 'unique:users|required',
            // 'type' => 'required',
            'status' => 'required',
            'gender' => 'required',
            'password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',


            'specilization' => 'required',
            'qualification' => 'required',
            'availability' => 'required',
            'time' => 'required',
            'charge' => 'required',

        ]);
    }
    public function validateUser()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'email|unique:users|required',
            'blood_group' => 'required',
            'phone_number' => 'unique:users|required',
            'type' => 'required',
            'status' => 'required',
            'gender' => 'required',
            'password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    }
    public function edit(User $user)
    {
        return view('admin.edit-doctor',compact('user'));
    }


    public function update(Request $request, User $user, Doctor $doctor)
    {
        $user->update( $this->updateValidationUser());
        return redirect()->route('admin.user-list');
        // if($request->type == "Doctor"){
        //    $user->update( $this->updateValidationUser());
        //     $user->doctor->update( $this->updateValidationDoctor());
        //     return redirect()->route('admin.user-list');
        // }
        // else{
        //     $user->update( $this->updateValidationUser());
        //     return redirect()->route('admin.user-list');
        // }
  
    }
    public function updateValidationUser()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'email|required',
            'blood_group' => 'required',
            'phone_number' => 'required',
            // 'type' => 'required',
            'status' => 'required',
            'gender' => 'required',
            'password' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
    }
    public function updateValidationDoctor()
    {
    return request()->validate([
            'specilization' => 'required',
            'qualification' => 'required',
            'availability' => 'required',
            'time' => 'required',
            'charge' => 'required',
        ]);
    }

    public function destroy(User $user)
    {
        $image_path ='uploads/profile-picture/'.$user->profile_pic;
        File::delete($image_path);
        $user->delete();
        return redirect('/doctors');
    }

    public function updateStatus(User $user)
    {
        if($user->status==="Enabled"){
            $user->status="Disabled";
            $user->save();
        return redirect()->back();
        }
        else 
        $user->status= 'Enabled';
        $user->save();
        return redirect()->back();
    }
}
