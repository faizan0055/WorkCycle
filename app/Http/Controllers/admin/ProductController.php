<?php

namespace App\Http\Controllers\admin;
use App\Chapter;
use App\Http\Controllers\Controller;

use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Chapter::all();
        $subCategories=SubCategory::all();
        $products=Product::get();
        return view('admin.products.index',compact('categories','products','subCategories'));
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
            'reference'=>'required',
            'price'=>'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $product = Product::create($request->all());
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=time().'-'.Str::slug($request->name, '-').'.'.$image->getClientOriginalExtension();
                $large_image_path='images/products/'.$fileName;
                //Resize Image
                Image::make($image)->resize(278,135)->save($large_image_path);
                $product->image = $fileName;
                $product->save();
            }
        }
        Session::flash('success','Created Successfully!!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories=Chapter::all();
        $subCategories=SubCategory::all();
        $products=Product::all();
        return view('admin.products.index',compact('product','categories','products','subCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required',
            'category_id'=>'required',
            'price'=>'required',
            'reference'=>'required',
        ]);

        $product->update($request->all());
        $image_small=url('images/products/',$product->image);
        if($request->file('image')){
            $image=$request->file('image');
            if($image->isValid()){
                $fileName=time().'-'.Str::slug($request->name, '-').'.'.$image->getClientOriginalExtension();
                $large_image_path='images/products/'.$fileName;
                //Resize Image
                Image::make($image)->resize(278,135)->save($large_image_path);
                if(file_exists($image_small)){
                    unlink($image_small);
                }
                $product->image = $fileName;
                $product->save();
            }
        }
        Session::flash('success','Updated Successfully!!');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        Session::flash('success','Deleted Successfully!!');
        return redirect()->back();
    }

    public function change_block_status(Request $request)
    {
        $user=Product::findOrFail($request->id);
        if ($user->status=='1')
            $user->status = '0';
        else
            $user->status = '1';

        $user->save();
        return redirect()->back();
    }
}

