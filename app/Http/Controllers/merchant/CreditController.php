<?php

namespace App\Http\Controllers\merchant;
use App\Admin;
use App\Credit;
use App\Driver;
use App\RedeemCode;
use App\Shop;
use App\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Required;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CreditController extends Controller
{
    //
    public function  balance()
    {
        $wallets=Wallet::where('user_id',auth()->user()->id)->get();
        return view('drivers.credit.balancehistory',compact('wallets'));
    }
    public function  recharge()
    {
        $shop=Driver::where('user_id',auth()->user()->id)->first();
        //dd($shop);
        return view('drivers.credit.recharge',compact('shop'));
    }
    public function  transfer()
    {
        $shop=Driver::where('user_id',auth()->user()->id)->first();
        return view('drivers.credit.transfer',compact('shop'));
    }
    public function  redeem()
    {
        $shop=Driver::where('user_id',auth()->user()->id)->first();
        return view('drivers.credit.redeem', compact('shop'));
    }

    public function  Commission()
    {
        $shop=Driver::where('user_id',auth()->user()->id)->first();
        return view('drivers.credit.comission', compact('shop'));
    }

    public function redeemRecharge(Request $request){
        $request->validate([
            'code'=>'required',
        ]);
        $redeem=RedeemCode::where('code',$request->code)->where('expiry_date', '>=', date('Y-m-d'))->where('status','available')->first();
         //dd($redeem);
        if($redeem!=null && $redeem!=''){
            $shop=Driver::where('user_id',auth()->user()->id)->increment('credit', $redeem->value);
            $admin=Admin::first()->increment('ewallet_recharge', $redeem->value);
            $redeem->status='unavailable';
            $redeem->save();
            Session::flash('success','Credit Updated Successfully!!');
            return redirect()->back();
        }
        else{
            Session::flash('success','Code Is Expired Or Unavailable!!');
            return redirect()->back();
        }

    }


    public function CreditTransfer(Request $request){
        $request->validate([
            'amount'=>'required',
        ]);
        //dd($request->all());
        $amount=(double)$request->amount;
        //dd($amount);
        if($amount > auth()->user()->drivers->wallet){
            Session::flash('error','Insufficient Wallet Balance!!');
            return redirect()->back();
        }
        else{
            $shop=Driver::where('user_id',auth()->user()->id)->first();
            $shop->increment('credit',$amount);
            $shop->first()->decrement('wallet',$amount);
            $admin=Admin::first();
            $admin->increment('ewallet_recharge',$amount);
            $admin->decrement('wallet',$amount);
            Session::flash('success','Credit Transfer Successfully!!');
            return redirect()->back();
        }

    }
}
