<?php

namespace App\Http\Controllers\merchant;
use App\AssignUser;
use App\Http\Controllers\Controller;
use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class NotificationController extends Controller
{
    //
    public function index(){
        $id=auth()->user()->id;
        $notifications=Notification::where(function ($query) use ($id) {
            $query->where('notification_for',$id)->orWhereNull('notification_for');
        })->latest()->get();
        return view('merchant.notification.index',compact('notifications'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $check=AssignUser::where('user_id',auth()->user()->id)->pluck('assigned_id');
        $users=User::whereIn('id',$check)->where('type','client')->get();
        return view('merchant.notification.create',compact('users'));
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
            'title' => 'required',
            'notification'=>'required',
        ]);
        if($request->notification_for=='all'){
            $check=AssignUser::where('user_id',auth()->user()->id)->get();
            foreach ($check as $user){
                $request['notification_for']=$user->assigned_id;
                $store=Notification::create($request->all());
            }
            if($store){
                Session::flash('success','Created Successfully!!');
                return redirect()->back();
            }
        }else{
            $store=Notification::create($request->all());
            if($store){
                Session::flash('success','Created Successfully!!');
                return redirect()->back();
            }
        }
    }
}
