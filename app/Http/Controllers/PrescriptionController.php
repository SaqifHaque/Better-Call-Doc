<?php

namespace App\Http\Controllers;

use App\Prescription;
use App\Appoinment;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
   
    public function store(Request $request, Appoinment $appoinment)
    {
        $prescription =new Prescription();
        $this->prescvalidate();
        $prescription->details = $request->pres;
        $prescription->disease = $request->dis;
        $prescription->prescribed_by = $appoinment->doctor_id;
        $prescription->appoinment_id = $appoinment->id;
        $prescription->save();
        $appoinment->prescription_id = $prescription->id;
        $appoinment->save();
        return redirect()->back();
    }
    public function prescvalidate()
    {
        return request()->validate([
            'details' => 'required',
            'disease' => 'required',
        ]);
    }

}
