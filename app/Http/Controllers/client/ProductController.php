<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Question;
use App\PaymentType;
use App\Chapter;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    public function  index(Request $request){
        $cate=auth()->user()->categories->pluck('id');
        if($request->has('query') AND $request->query!=''){
            $products=Product::where('status','1')->whereIn('category_id',$cate)->where('name', 'like', '%' . $request->get('query') . '%')->get();
        }
        else{
            $products=Product::where('status','1')->whereIn('category_id',$cate)->get();
        }
        $news=Question::latest()->first();
        return view('client.products.index',compact('products','news'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewProduct($id)
    {
        $html='';
        $products=Product::find($id);
        $payment_types=PaymentType::get();
        $price=$products->price-($products->price*$products->discount/100);

        $html.='<div class="row">
                        <div class="col-5">
                            <img src="'.url('images/products',$products->image).'" width="150">
                            <input type="hidden" id="product_id" value="'.$products->id.'">
                        </div>
                        <div class="col-7">
                            <div class="row">
                            <div class="col-12">
                            <div class="form-group">
                                <p class="mg-b-10">Qty</p>
                                <select class="form-control select2-no-search w-100" name="qty" id="qty">';
                                    for($i=1; $i<=$products->stocks->where('in_stock','1')->count(); $i++){
                                        $html.='<option value="'.$i.'">'.$i.'</option>';
                                    }
                                $html.='</select>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mg-t-10">
                        <div class="col-lg-6">
                            <span><b>Price:</b> $<span id="price">'.$price.'</span></span>
                        </div>
                        <div class="col-lg-6 mg-t-20 mg-lg-t-0">
                            <span><b>Total Amount:</b> $<span id="total">'.$price.'</span></span>
                        </div>
                    </div>
                    <div class="row row-sm mg-t-20">
                        <div class="col-lg" id="showItems">

                        </div>
                    </div>';
        return $html;
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
    //
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
