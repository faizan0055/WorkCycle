<?php

namespace App\Http\Controllers\client;
use App\Admin;
use App\Http\Controllers\Controller;
use App\OrderStock;
use App\History;
use App\Stock;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=History::where('user_id',auth()->user()->id)->latest()->get();
        return view('client.order.index',compact('orders'));
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
        //return $request->all();
        $request['user_id']=auth()->user()->id;
        //return $request->all();
        $admin=Admin::first();
        if(auth()->user()->credit>=$request->total){
            $pro=Product::find($request->product_id);
            $request['total']=$pro->price*$request->qty;
            $request['price']=$pro->price;
            $getStocks=Stock::where('product_id',$request->product_id)->where('in_stock','1')->limit($request->qty)->get();

            //Update Stock
            if($request->qty > 0 AND $getStocks->count()>=$request->qty){
                $order=History::create($request->all());
                if($order){
                    $licenses=$getStocks->pluck('license');
                    for($ii = 0; $ii < count($getStocks->pluck('license')) ; $ii++) {
                        $license=$licenses[$ii];
                        OrderStock::create([
                            'order_id' => $order->id,
                            'license'=>$license,
                        ]);
                    }
                }
                $admin->increment('wallet',$order->total);
                auth()->user()->decrement('credit',$order->total);
                $updateProduct = Stock::whereIn('id',$getStocks->pluck('id'))
                    ->update(['in_stock' => '0']);
                return response()->json([
                    'status'=>true,
                    'message'=>"Order placed Successfully!"
                ]);
            }
            else{
                return response()->json([
                    'status'=>false,
                    'message'=>"Sorry something went wrong!."
                ]);
            }

        }else{
          return response()->json([
             'status'=>false,
              'message'=>"You Don't have enough balance!"
          ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=History::findOrFail($id);
        return view('client.order.show',compact('order'));
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
