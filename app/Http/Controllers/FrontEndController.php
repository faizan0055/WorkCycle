<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Mail\ContactMail;
use App\Property;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontEndController extends Controller
{
    public function index(){
        $latestproperty = Property::where('status','=','0')->latest()->take(6)->get();
        $agents = User::where('type','merchant')->latest()->take(6)->get();
        $blogs = Advertisement::latest()->take(2)->get();
       // dd($agents);
        return view('frontend.index',compact('latestproperty','agents','blogs'));
    }
    public function about(){
        return view('frontend.about');
    }
    public function propertyGrid(){
        $properties = Property::all();
        return view('frontend.property-grid',compact('properties'));
    }
    public function blogGrid(){
        $blogs = Advertisement::all();
        return view('frontend.blog-grid',compact('blogs'));
    }
    public function ProperSingle(){
        return view('frontend.property-single');
    }
    public function BlogSingle(){
        return view('frontend.blog-single');
    }
    public function agentGrid(){
        $agents = User::where('type','merchant')->get();
        return view('frontend.agents-grid',compact('agents'));
    }
    public function agentSigle(){
        return view('frontend.agent-single');
    }
    public function contact(){
        return view('frontend.contact');
    }
    public function SearchProperty(Request $request){
        //dd($request->bath);
        if(!$request->name && !$request->type && !$request->bed && !$request->bath){
            $proprtyname = 'Dhakafghj';
            $proprtytype = 'Housedfgh';
            $proprtybed = 'House1dfgh';
            $proprtybath = 'House2dfgh';

        }
        else{
            $proprtyname = $request->name;
            $proprtytype = $request->type;
            $proprtybed = $request->bed;
            $proprtybath = $request->bath;

        }
        $search = Property::where('name', 'like', '%' . $proprtyname . '%')
            ->Where('type', 'like', '%' . $proprtytype . '%')
            ->Where('bed', 'like', '%' . $proprtybed . '%')
            ->Where('washroom', 'like', '%' . $proprtybath . '%')
            ->get();
        //dd($search);
        return view('frontend.search_property', compact('search'));
    }
    public function ContactUs(Request $request){
        //dd($request->all());
        $contactdata = $request->all();
        Mail::to('bc180407881@vu.edu.pk')->send(new ContactMail($contactdata));

        return redirect()->back();

    }
}
