<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Appoinment;
use App\Doctor;
use App\Rating;
use Illuminate\Http\Request;
Use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

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

        $did = DB::table('users')
        ->where("id",$id)
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
                    ->with("avg",$avg)
                    ->with("did",$did);
    }
    public function TakeAppointment( Request $req , $id)
    {     
        $validator = Validator::make($req->all(), [
            'date' => 'required',
            'time' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('user.doctor',[$id])->with('errors',$validator->errors())->withInput();
        }
        else{
            $doctor = DB::table('doctors')->where("user_id",$id)->first();
            $appoinment = new Appoinment();
            $appoinment->date = $req->date;
            $appoinment->time = $req->time;
            $appoinment->status ="Pending";
            $appoinment->user_id = $req->session()->get('id');
            $appoinment->doctor_id = $doctor->id;
            //$appoinment->prescription_id = "";
            $appoinment->save();
            Mail::raw('Your Appointment has been set'.$req->date." ".$req->time, function($message) use ($req)
            {
                $message->subject('Appointment has been Schduled!');
                $message->from('no-reply@bettercalldoc.com', 'BetterCallDoc');
                $message->to($req->session()->get('email'));
            });
        return redirect()->route('user.app');
     }    
    }
    public function AppTable(Request $req){
        $appointments = DB::table('appoinments')
                                            ->where('user_id',$req->session()->get("id"))
                                            ->get();
        return View("user.apptable")->with("app",$appointments);
    } 

    public function Notice()
    {
        $notice = DB::table('notices')
                        ->orderBy('id', 'desc')
                        ->get();
        return view('user.notices')->with('notice',$notice);

    }

    public function profile()
    {
        $id = session()->get("id");
        $user = DB::table('users')->where('id',$id)->first();
        
        return view('user.myprofile', compact('id','user'));

    }
    public function editProfile(Request $req, User $user)
    {
        $user->update($this->profileValidation());
        
        return redirect()->route('user.profile',[$req->session()->get("id")]);
    }
    public function editPic(Request $req, User $user){
        if ($req->hasfile('dp')) {
            $file = $req->file('dp');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/profile-picture/', $filename);
            $user->profile_pic = $filename;
        }
        $user->update($this->picValidation());
        return redirect()->route('user.profile');
    }


    public function profileValidation(){
        return request()->validate([
            'name' => 'required',
            'password' => 'required'

        ]);
    }
    public function picValidation(){
        return request()->validate([
           'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
    }
    public function Cancel(Appoinment $appoinment)
    {
        $appoinment->status = "Cancelled";
        $appoinment->save();
        return redirect()->route('user.app');
    }
    public function Review(Request $req, $id)
    {
        $review = DB::table("ratings")->where("doctor_id",$id)
                        ->where('user_id',$req->session()->get("id"))->get();
                        if($review){
                            $msg = "Done";
                        }else{
                            $msg = "";
                        }
        return View('user.review')->with("id",$id)->with("msg",$msg);
    }
    public function Rated(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'rating' => 'required',
            'review' => 'required|min:4',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('user.review',[$id])->with('errors',$validator->errors())->withInput();
        }else{
            $rating = new Rating();
            $rating->rating = $req->rating;
            $rating->review = $req->review;
            $rating->user_id = $req->session()->get('id');
            $rating->doctor_id = $id;
            $rating->save();
            return redirect()->route('user.app');
        }
    }
}
