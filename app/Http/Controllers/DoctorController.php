<?php

namespace App\Http\Controllers;

use App\User;
use App\Doctor;
use App\Appoinment;
use App\Finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
   
    public function show(Request $req,Doctor $doctor)
    {
       // $doctor = DB::table('doctors')->where('user_id',$req->session()->get('id'))->first();
        $reviews = DB::table('ratings')->where('doctor_id',$doctor->id)->get();
        $rating = 0;

        foreach($reviews as $r)
        {
            $rating +=(int)$r->rating;
        }
        $numrev = count($reviews);
        if($numrev!=0)
        $rating = $rating/$numrev;
        else
        $rating = "Not Rated Yet";
        //$userCount = $doctor->appointment->user->count();

        $userCount = Appoinment::where('doctor_id', $doctor->id)
            ->distinct()->get('user_id');
        $userCount = count($userCount);
       
        return view('doctor.docdash', compact('doctor', 'userCount','reviews',"numrev",'rating'));
    }

    public function updateAppointmentStatus(Appoinment $appoinment, Finance $finance)
    {
        $appoinment->status = "Completed";
        $appoinment->save();
        $finance->details = $appoinment->doctor->charge;
        $finance->user_id = $appoinment->user->id;
        $finance->save();
        return redirect()->back();
    }

    public function setTime(Request $request, Doctor $doctor)
    {
        $this->timeValidate();
        $str = array();
        $days = "";
        $input = $request->all();
        $input['days'] = $request->input('days');
        foreach ($input["days"] as $s) {
            $days .= $s . ",";
        }
        $to = $request->to;
        $from =  $request->from;
        $date = $from . "-" . $to;
        $doctor->availability = $days;
        $doctor->time = $date;
        $doctor->save();
        return redirect()->back();
    }
    public function timeValidate()
    {
        return request()->validate([
            'days[]' => 'required',
            'from' => 'required',
            'to' => 'required'
        ]);
    }
}
