<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notice;

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
    public function store(Request $request, Notice $notice)
    {
        $notice->details = $request->details;
        $notice->posted_by = "Admin";
        $notice->save();
        return redirect()->back();
    }
}
