<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Request;
Use Carbon\Carbon;

class UserController extends Controller
{
    public function UserDash(){
        $doctors = DB::table('doctors')
                                ->join('users','doctors.user_id','=','users.id')
                                ->select('doctors.*','users.*')
                                ->get();
        
        return View("user.userdash")->with('doctors',$doctors);
    }
    public function DoctorDetails($id){
        $doctor=DB::table('doctors')
        ->join('users','doctors.user_id','=','users.id')
        ->select('doctors.*','users.*')
        ->where('doctors.user_id','=',$id)
        ->get();
        $date = date("l");
        echo $date;


        return View("user.appointment")->with('doctor',$doctor);
    }


}
