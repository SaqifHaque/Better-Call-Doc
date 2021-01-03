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
        ->first();
        $splitweek = explode(',', $doctor->availability);
        $current = Carbon::now();
        $availability = array();
        $time = array();
        $week = $current->format('l');
            if(in_array($week, $splitweek))
            {
                array_push($availability, $current->toDateString());
            }
        for($i=0; $i<=20; $i++){
            $date = $current->addDays(1);
            $week = $date->format('l');
            if(in_array($week, $splitweek))
            {
                array_push($availability, $date->toDateString());
            }
        }
        $splitime = explode('-', $doctor->time);
        $start = explode(':', $splitime[0]);
        $end = explode(':', $splitime[1]);

        $startTime = $start[0];
        $endTime = $end[0];

        while($startTime!=$endTime)
        {
            $t = $startTime.":00-".strval((int)$startTime+1).":00";
            array_push($time, $t);
            $startTime = strval((int)$startTime+1);
        }
        $ratings=DB::table('ratings')
                    ->join('users','ratings.user_id','=','users.id')
                    ->select('ratings.*','users.*')
                    ->where('ratings.doctor_id','=',$doctor->$id)
                    ->get();

        return View("user.appointment")
                    ->with('doctor',$doctor)
                    ->with("availability",$availability)
                    ->with("time",$time)
                    ->with("ratings",$ratings);
    }


}
