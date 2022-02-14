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
        ]);
        //dd($request->all());
        $business_type = Property::create($request->all());
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=time().'-'.Str::slug($request->name, '-').'.'.$image->getClientOriginalExtension();
                $large_image_path='images/properties/'.$fileName;
                //Resize Image
                Image::make($image)->resize(250,250)->save($large_image_path);
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
    public function edit(Property $propertys)
    {

        $propertiess=Property::all();
        return view('admin.propertiess.index',compact('propertys','propertiess'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $propertys)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'nullable|mimes:jpg,jpeg,png',
            'category_id'=>'required',
            'price'=>'required',
        ]);

        $image_small='images/properties/'.$propertys->image;
        $propertys->update($request->all());
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=time().'-'.Str::slug($request->name, '-').'.'.$image->getClientOriginalExtension();
                $large_image_path='images/properties/'.$fileName;
                //Resize Image
                Image::make($image)->resize(250,250)->save($large_image_path);
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
    public function destroy(Property $propertys)
    {
        $image=url('images/properties/',$propertys->image);
        if(file_exists($image)){
            unlink($image);
        }
        $propertys->delete();
        Session::flash('success','Deleted Successfully!!');
        return redirect()->back();
    }
}
