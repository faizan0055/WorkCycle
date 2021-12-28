<?php

namespace App\Http\Controllers\merchant;
use App\Admin;
use App\Driver;
use App\Shop;
use App\ShopMenu;
use App\Subscribe;
use App\Http\Controllers\Controller;
use App\SubscribedPackage;
use App\Subscription;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class SubscribeController extends Controller
{

   public function add_months($months, DateTime $dateObject)
    {
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');

        if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new DateInterval('P'.$months.'M');
        }
    }
    public function dateCycle($d1, $months)
    {
        $date = new DateTime($d1);

        // call second function to add the months
        $newDate = $date->add($this->add_months($months, $date));

        // goes back 1 day from date, remove if you want same day of month
        $newDate->sub(new DateInterval('P1D'));

        //formats final date to Y-m-d form
        $dateReturned = $newDate->format('Y-m-d');

        return $dateReturned;
    }

     public function sub()
     {
        $subscriptions=Subscription::where('user_type','driver')->get();
         $usedSub = SubscribedPackage::where('user_id', auth()->user()->id)->latest()->get();
       return view('drivers.subscribe.index',compact('subscriptions','usedSub'));

     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subscription=Subscription::findOrFail($id);
        return view('drivers.subscribe.create',compact('subscription'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        $request['start_date']=$request->start_date.' '.date('H:i:s');
        $request['end_date']=$request->end_date.' '.date('H:i:s');
        //dd($request->all());
        $shop=Driver::where('user_id',auth()->user()->id)->first();
        $check = SubscribedPackage::where('user_id', auth()->user()->id)->where('end_date','>', date('Y-m-d H:i:s'))->latest()->first();
        if($check){
            Session::flash('error', 'You already have an active subscription!!');
            return redirect()->route('subscribe.index');
        }
        elseif ($shop->credit >= $request->amount) {
            $admin=Admin::first()->increment('balance', $request->amount);
            $shop->decrement('credit', $request->amount);
            $store = SubscribedPackage::create($request->all());
            if ($store) {
                Session::flash('success', 'Updated Successfully!!');
                return redirect()->back();
            } else {
                return redirect()->back();
            }
            return redirect()->back();
        }
        else{
            Session::flash('error', 'Insufficient Balance! Please Recharge Your Account.');
            return redirect()->back();
        }
    }

    public function upgrade($id)
    {
        $subscription=SubscribedPackage::findOrFail($id);
        $shop=Driver::where('user_id',auth()->user()->id)->first();
        $startDate = Carbon::parse($subscription->end_date)->format('Y-m-d'); // select date in Y-m-d format
        $nMonths = $subscription->duration; // choose how many months you want to move ahead
        $final=$this-> dateCycle($startDate, (int)$nMonths);

        $subscription->end_date=$final.' '.date('H:i:s');
        //dd($final);
        $subscription->save();

        $admin=Admin::first()->increment('balance', $subscription->amount);
        $shop->decrement('credit', $subscription->amount);

        Session::flash('success', 'Subscription Upgraded Successfully.');
        return redirect()->back();
    }


}
