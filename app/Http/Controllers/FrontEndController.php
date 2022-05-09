<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index(){
        $latestproperty = Property::latest()->take(6)->get();
       // dd($latestproperty);
        return view('frontend.index',compact('latestproperty'));
    }
    public function about(){
        return view('frontend.about');
    }
    public function propertyGrid(){
        return view('frontend.property-grid');
    }
    public function blogGrid(){
        return view('frontend.blog-grid');
    }
    public function ProperSingle(){
        return view('frontend.property-single');
    }
    public function BlogSingle(){
        return view('frontend.blog-single');
    }
    public function agentGrid(){
        return view('frontend.agents-grid');
    }
    public function agentSigle(){
        return view('frontend.agent-single');
    }
    public function contact(){
        return view('frontend.contact');
    }
}
