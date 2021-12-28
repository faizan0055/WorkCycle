<?php

namespace App\Http\Controllers\merchant;
use App\BankAccount;
use App\CreditRequest;
use App\Shop;
use App\Wallet;
use App\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class WalletController extends Controller
{
    public  function withdrawRequest(){
        $shop=Driver::where('user_id',auth()->user()->id)->first();
        return view('drivers.wallet.index',compact('shop'));
    }

    public  function totalEarn(){
        $shop=Driver::where('user_id',auth()->user()->id)->first();
        return view('drivers.wallet.total_earn',compact('shop'));
    }

    public  function bank(){
        $banks=BankAccount::where('user_id',auth()->user()->id)->get();
        return view('drivers.wallet.bank',compact('banks'));
    }

    public  function bankSave(Request $request){
        $request->validate([
            'account_number'=>'required',
            'account_name'=>'required',
            'bank_name'=>'required',
            'branch_name'=>'required',
            'swift_code'=>'required',
        ]);
        $request['user_type']='driver';
        $request['user_id']=auth()->user()->id;
        $bank=BankAccount::create($request->all());
        if($bank){
            Session::flash('success', 'Created Successfully!!');
            return redirect()->back();
        }
    }

    public function storeWithdraw(Request $request){
        $request->validate([
            'amount'=>'required|integer',
        ]);
        $request['user_id']=auth()->user()->id;
        $request['user_type']=auth()->user()->type;
        $request['ctype']='Withdraw';
        CreditRequest::create($request->all());
        Session::flash('success','Request Sent Successfully!!');
        return redirect()->back();
    }

    public function withdarwHistory(){
        $history=CreditRequest::where('user_id',auth()->user()->id)->get();
        return view('drivers.wallet.withdrawhistory',compact('history'));
    }

    public function walletHistory(){

        return view('drivers.wallet.wallethistory');
    }

    public function store(Request $request){
        $request->validate([
            'credit_amount'=>'required',
            'transaction_id' => 'required',
            'payment_method' => 'required',
        ]);
        if(auth()->user()->drivers->credit < $request->credit_amount){
            Session::flash('error','Insufficient Credit!!');
            return redirect()->back();
        }
        else{
            $request['user_id']=auth()->user()->id;
            $request['user_type']=auth()->user()->type;
            $request['wallet_type']='Request';
            Wallet::create($request->all());
            Session::flash('success','Request Sent Successfully!!');
            return redirect()->back();
        }
    }

}
