<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Consult;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ConsultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consults=Consult::where('user_id', auth()->user()->id)->get();
        return view('merchant.consults2.index',compact('consults'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question'=>'required',
            'reply'=>'nullable',

        ]);
        $request['user_id'] = auth()->user()->id;
        //dd($request->all());
        $consult = Consult::create($request->all());

        $consult->save();
        Session::flash('success','Question Send Successfully!!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($consult)
    {
        $consults=Consult::where('user_id', auth()->user()->id)->get();
        //$consults=Consult::all();
        $consult=Consult::findOrFail($consult);
        return view('merchant.consults2.index',compact('consults','consult'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $consult)
    {
        $request->validate([
            'question'=>'required',
            'reply'=>'nullable',

        ]);
        $consult=Consult::findOrFail($consult);
        $consult->update($request->all());

        $consult->save();
        Session::flash('success','Question Updated Successfully!!');
        return redirect()->route('consults2.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consult $consults2)
    {
//        $consults2=Consult::findOrFail($consults2);
        $consults2->delete();
        Session::flash('success','Deleted Successfully!!');
        return redirect()->back();
    }
}
