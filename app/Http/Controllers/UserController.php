<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Appoinment;
use App\Doctor;
use Illuminate\Http\Request;
Use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
        $avg = 0;
        $ratings=DB::table('ratings')
                    ->join('users','ratings.user_id','=','users.id')
                    ->select('ratings.*','users.*')
                    ->where('ratings.doctor_id','=',$doctor->id)
                    ->get();
        for($j=0;$j<count($ratings);$j++){
            $avg+=(int)$ratings[$j]->rating;
        }
        if($avg!=0){
            $avg = $avg/count($ratings);
        }
        
        return View("user.appointment")
                    ->with('doctor',$doctor)
                    ->with("availability",$availability)
                    ->with("time",$time)
                    ->with("ratings",$ratings)
                    ->with("avg",$avg);
    }
    public function TakeAppointment( Doctor $doctor, Request $req)
    {     
        $validator = Validator::make($req->all(), [
            'date' => 'required',
            'time' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('user.doctor',[$doctor->id])->with('errors',$validator->errors())->withInput();
        }
        else{
            $appoinment = new Appoinment();
            $appoinment->date = $req->date;
            $appoinment->time = $req->time;
            $appoinment->status ="Pending";
            $appoinment->user_id = $req->session()->get('id');
            $appoinment->doctor_id = $doctor->id;
            $appoinment->prescription_id = 0;
            $appoinment->save();
            Mail::raw('Your Appointment has been set'.$req->date." ".$req->time, function($message) use ($user)
            {
                $message->subject('Appointment has been Schduled!');
                $message->from('no-reply@bettercalldoc.com', 'BetterCallDoc');
                $message->to($req->session()->get('email'));
            });
        return redirect()->route('user.app');
     }    
    }
    public function AppTable(Request $req){
        $appointments = DB::table('appointments')
                                            ->join('doctors','appointments.doctor_id','=','doctors.id')
                                            ->select('appointments.*','doctors.*')
                                            ->where('user_id',$req->session->get("id"))
                                            ->first();
        return View("user.apptable")->with("app",$appointments);
    } 
   
}
