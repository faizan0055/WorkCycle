<?php

namespace App\Http\Controllers\admin;

use App\Bidd;
use App\Http\Controllers\Controller;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Image;
class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bids=Bidd::all();
        return view('admin.admin_bidd.index',compact('bids'));
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
       // dd($request->all());
        $request->validate([
            'name'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png',
            'description'=>'required',
            'price'=>'required',
            'type'=>'required',
            'size'=>'required',
            'bed'=>'required',
            'washroom'=>'required',
            'start_datetime'=>'required',
            'end_datetime'=>'required',

        ]);
        //dd($request->all());
        $request['user_id'] = auth()->user()->id;
        $business_type = Bidd::create($request->all());
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=time().'-'.Str::slug($request->name, '-').'.'.$image->getClientOriginalExtension();
                $large_image_path='images/bidds/'.$fileName;
                //Resize Image
                Image::make($image)->resize(250,250)->save($large_image_path);
                $business_type->image = $fileName;
                $business_type->save();
            }
        }
        Session::flash('success','Create Bid Successfully!!');
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
    public function edit($bidds)
    {
        $bids=Bidd::all();
        $bidds=Bidd::findOrFail($bidds);
        return view('admin.admin_bidd.index',compact('bidds','bids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bidds)
    {
        $request->validate([
            'name'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png',
            'description'=>'required',
            'price'=>'required',
            'type'=>'required',
            'size'=>'required',
            'bed'=>'required',
            'washroom'=>'required',
            'start_datetime'=>'required',
            'end_datetime'=>'required',
        ]);
        //dd($request->all());
        $bidds=Bidd::findOrFail($bidds);
        //dd($propertys);
        $image_small='images/properties/'.$bidds->image;
        $bidds->name=$request->name;
        $bidds->description=$request->description;
        $bidds->start_datetime=$request->start_datetime;
        $bidds->end_datetime=$request->end_datetime;
        $bidds->price=$request->price;
        $bidds->type=$request->type;
        $bidds->size=$request->size;
        $bidds->bed=$request->bed;
        $bidds->washroom=$request->washroom;
        $bidds->save();
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=time().'-'.Str::slug($request->name, '-').'.'.$image->getClientOriginalExtension();
                $large_image_path='images/bidds/'.$fileName;
                //Resize Image
                Image::make($image)->resize(250,250)->save($large_image_path);
                if(file_exists($image_small)){
                    unlink($image_small);
                }
                $bidds->image = $fileName;
                $bidds->save();
            }
        }
        Session::flash('success','Updated Successfully!!');
        return redirect()->route('admin_bidd.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($bidds)
    {
        $bidds=Bidd::findOrFail($bidds);
        $image=url('images/bidds/',$bidds->image);
        if(file_exists($image)){
            unlink($image);
        }

        $bidds->delete();
        Session::flash('success','Deleted Successfully!!');
        return redirect()->back();
    }
}
