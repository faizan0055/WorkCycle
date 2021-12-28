<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\SubCategory;
use App\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Chapter::all();
        $sub_categories=SubCategory::all();
        return view('admin.category.create',compact('categories','sub_categories'));
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
            'category_id'=>'required',
        ]);

        $business_type = SubCategory::create($request->all());
        Session::flash('success','Created Successfully!!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $categories=Chapter::all();
        $sub_categories=SubCategory::all();
        return view('admin.category.create',compact('subCategory','categories','sub_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'name'=>'required',
            'category_id'=>'required',
        ]);
        $subCategory->update($request->all());
        Session::flash('success','Updated Successfully!!');
        return redirect()->route('sub_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        Session::flash('success','Deleted Successfully!!');
        return redirect()->back();
    }
}
