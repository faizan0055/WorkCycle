<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Advertisement;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisements=Advertisement::all();
        return view('admin.advertisements.index',compact('advertisements'));
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

            'detail'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png',
        ]);
        $advertisement = Advertisement::create($request->all());
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=Str::slug($request->advertisement, '-').time().'.'.$image->getClientOriginalExtension();
                $large_image_path='images/advertisement/'.$fileName;
                //Resize Image
                Image::make($image)->resize(300,250)->save($large_image_path);
                $advertisement->image = $fileName;
                $advertisement->save();
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
    public function edit(Advertisement $advertisement)
    {
        //$advertisement=Advertisement::findOrFail($advertisement);
        $advertisements=Advertisement::all();
        return view('admin.advertisements.index',compact('advertisements','advertisement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $advertisement)
    {
        $request->validate([
            'name'=>'required',
            'detail'=>'required',
            'image'=>'nullable|mimes:jpg,jpeg,png',
        ]);
        $advertisement=Advertisement::findOrFail($advertisement);
        $advertisement->update($request->all());
        $image_small=url('images/advertisement/',$advertisement->image);
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=Str::slug($request->advertisement, '-').time().'.'.$image->getClientOriginalExtension();
                $large_image_path='images/advertisement/'.$fileName;
                //Resize Image
                Image::make($image)->resize(300,250)->save($large_image_path);
                if(file_exists($image_small)){
                    unlink($image_small);
                }
                $advertisement->image = $fileName;
                $advertisement->save();
            }
        }
        Session::flash('success','Updated Successfully!!');
        return redirect()->route('advertisements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
        Session::flash('success','Deleted Successfully!!');
        return redirect()->back();
    }
}
