<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WeatherController extends Controller
{
    public function store(request $request)
    {
        $zipCode = $request->zip_code;
        $_POST['zip_code'] = $zipCode;
        return view('welcome',['zip_code'=>$zipCode]);
    }
}
