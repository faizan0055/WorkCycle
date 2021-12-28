<?php

namespace App\Http\Controllers\merchant;
use App\Http\Controllers\Controller;
use App\AssignUser;
use App\History;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        $check=AssignUser::where('user_id',auth()->user()->id)->pluck('assigned_id');
        $orders=History::whereIn('user_id',$check)->get();
        return view('merchant.order.index',compact('orders'));
    }


    public function show($id)
    {
        $order=History::find($id);
        return view('client.order.show',compact('order'));
    }

    public function store(Request $request)
    {
        $order=History::find($request->order_id);
        if($order AND $request->amount>0 AND $request->amount!=''){
            $order->total=$request->amount;
            $order->user()->decrement('credit',$request->amount);
            $order->save();

            return response()->json([
                'status'=>true,
                'message'=>'Successfully Created!!'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Something went wrong!!'
            ]);
        }
    }

}
