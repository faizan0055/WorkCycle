<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Image;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapters=Chapter::all();
        return view('admin.chapters.index',compact('chapters'));
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
            'image'=>'mimes:jpg,jpeg,png,gif',
            'video' => '',
            'description'=>'required',
        ]);
        //dd($request->all());
        $business_type = Chapter::create($request->all());
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=time().'-'.Str::slug($request->name, '-').'.'.$image->getClientOriginalExtension();
                $large_image_path='images/chapters/'.$fileName;
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
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(ChapterController $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit(Chapter $chapter)
    {
        $chapters=Chapter::all();
        return view('admin.chapters.index',compact('chapter','chapters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoryController  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chapter $chapter)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'nullable|mimes:jpg,jpeg,png,gif',
        ]);

        $image_small='images/chapters/'.$chapter->image;
        $chapter->update($request->all());
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=time().'-'.Str::slug($request->name, '-').'.'.$image->getClientOriginalExtension();
                $large_image_path='images/chapters/'.$fileName;
                //Resize Image
                Image::make($image)->resize(250,250)->save($large_image_path);
                if(file_exists($image_small)){
                    unlink($image_small);
                }
                $chapter->image = $fileName;
                $chapter->save();
            }
        }
        Session::flash('success','Updated Successfully!!');
        return redirect()->route('chapters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {
        $image=url('images/chapters/',$chapter->image);
        if(file_exists($image)){
            unlink($image);
        }
        $chapter->delete();
        Session::flash('success','Deleted Successfully!!');
        return redirect()->back();
    }
}
