<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Image;
class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertiess=Property::all();
        return view('admin.propertiess.index',compact('propertiess'));
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
            'name'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png',
            'description'=>'required',
            'category_id'=>'required',
            'price'=>'required',
            'type'=>'required',
            'size'=>'required',
            'bed'=>'required',
            'washroom'=>'required',

        ]);
        //dd($request->all());
        $request['user_id'] = auth()->user()->id;
        $business_type = Property::create($request->all());
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=time().'-'.Str::slug($request->name, '-').'.'.$image->getClientOriginalExtension();
                $large_image_path='images/properties/'.$fileName;
                //Resize Image
                Image::make($image)->save($large_image_path);
                $business_type->image = $fileName;
                $business_type->save();
            }
        }
        Session::flash('success','Updated Successfully!!');
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
    public function edit($propertys)
    {
        //dd($propertys);
        $propertiess=Property::all();
        $propertys=Property::findOrFail($propertys);
        return view('admin.propertiess.index',compact('propertys','propertiess'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $propertys)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'nullable|mimes:jpg,jpeg,png',
            'category_id'=>'required',
            'price'=>'required',
            'type'=>'required',
            'size'=>'required',
            'bed'=>'required',
            'washroom'=>'required',
        ]);
        //dd($request->all());
        $propertys=Property::findOrFail($propertys);
        //dd($propertys);
        $image_small='images/properties/'.$propertys->image;
        $propertys->name=$request->name;
        $propertys->description=$request->description;
        $propertys->category_id=$request->category_id;
        $propertys->price=$request->price;
        $propertys->type=$request->type;
        $propertys->size=$request->size;
        $propertys->bed=$request->bed;
        $propertys->washroom=$request->washroom;
        $propertys->save();
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=time().'-'.Str::slug($request->name, '-').'.'.$image->getClientOriginalExtension();
                $large_image_path='images/properties/'.$fileName;
                //Resize Image
                Image::make($image)->save($large_image_path);
                if(file_exists($image_small)){
                    unlink($image_small);
                }
                $propertys->image = $fileName;
                $propertys->save();
            }
        }
        Session::flash('success','Updated Successfully!!');
        return redirect()->route('propertiess.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($propertys)
    {
        $propertys=Property::findOrFail($propertys);
        $image=url('images/properties/',$propertys->image);
        if(file_exists($image)){
            unlink($image);
        }

        $propertys->delete();
        Session::flash('success','Deleted Successfully!!');
        return redirect()->back();
    }
    public function change_property_status_admin(Request $request){
        $user=Property::findOrFail($request->id);
        //dd($user);
        if ($user->status)
            $user->status = false;
        else
            $user->status = true;

        $user->save();
        //Session::flash('success',' Successfully!!');
        return redirect()->back();
    }


}
