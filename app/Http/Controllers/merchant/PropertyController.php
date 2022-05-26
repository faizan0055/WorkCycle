<?php

namespace App\Http\Controllers\merchant;

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
        $properties=Property::where('user_id', auth()->user()->id)->get();
        return view('merchant.properties.index',compact('properties'));
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
            'name'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png',
            'description'=>'required',
            'category_id'=>'required',
            'price'=>'required',
            'type'=>'required',
            'size'=>'required',
            'bed'=>'required',
            'washroom'=>'required',

           // 'user_id'=>'required',
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
    public function edit(Property $property)
    {

        $properties=Property::where('user_id', auth()->user()->id)->get();
        return view('merchant.properties.index',compact('property','properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
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

        $image_small='images/properties/'.$property->image;
        $property->update($request->all());
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
                $property->image = $fileName;
                $property->save();
            }
        }
        Session::flash('success','Updated Successfully!!');
        return redirect()->route('properties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $image=url('images/properties/',$property->image);
        if(file_exists($image)){
            unlink($image);
        }
        $property->delete();
        Session::flash('success','Deleted Successfully!!');
        return redirect()->back();
    }
    public function change_property_status(Request $request){
        $user=Property::findOrFail($request->id);
        //dd($user);
        if ($user->status)
            $user->status = false;
        else
            $user->status = true;

        $user->save();
        return redirect()->back();
    }
}
