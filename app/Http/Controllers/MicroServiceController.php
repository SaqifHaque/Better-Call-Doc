<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class MicroServiceController extends Controller
{
    public function Search($str){
        $client = new Client();
        $response = $client->request('GET', 'http://localhost:2020/user/search/'.$str);
        $doctor = json_decode($response->getBody());
        return View('user.search')->with('doctors',$doctor);

    }
}
