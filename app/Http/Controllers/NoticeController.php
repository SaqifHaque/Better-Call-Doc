<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller
{
    public function Notice()
    {
        $notices = DB::table('notices')
                        ->latest()
                        ->take(5)
                        ->get();

            return response($notices->toJson(),200);
    }
}
