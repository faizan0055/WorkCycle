<?php

namespace App\Http\Controllers\client;

use App\BiddParticipate;
use App\Consult;
use App\Http\Controllers\Controller;
use App\Property;
use App\Bidd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $props=Bidd::all();
        $closed = Bidd::where('start_datetime' , '<=' , now())->get();
        return view('client.buyer_bidd.index',compact('props','closed'));
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
        //dd($request->all());
        $request->validate([
            'price'=>'required',
        ]);
        $request['user_id'] = auth()->user()->id;
        $consult = BiddParticipate::create($request->all());

        $consult->save();
        Session::flash('success','Bidd Price Updated Successfully!!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $st = Bidd::where('id',$id)->where('start_datetime' , '<=' , now())->where('end_datetime' , '>=' , now())->first();
        $closed = Bidd::where('id',$id)->where('start_datetime' , '<=' , now())->first();
        //dd($closed);
        $bidprice = BiddParticipate::where('bidproperty_id',$id)->orderBy('id', 'desc')->first();
        $bidd = Bidd::findOrFail($id);
        return view('client.buyer_bidd.show',compact('bidd','bidprice','st','closed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
