<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgetPassController extends Controller
{
    public function index(){
    return view('auth.forget_password');
    }
}
