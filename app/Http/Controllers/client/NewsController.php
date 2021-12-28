<?php

namespace App\Http\Controllers\client;
use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index(){
        $news=Question::latest()->get();
        return view('client.notification.questions',compact('news'));
    }
}
