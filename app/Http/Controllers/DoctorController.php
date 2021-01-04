<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function doctorDash(){
        return View('doctor.docdash');
    }
}
