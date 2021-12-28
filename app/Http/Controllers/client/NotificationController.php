<?php

namespace App\Http\Controllers\client;
use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;


class NotificationController extends Controller
{

    public function index(){
        $id=auth()->user()->id;
        $notifications=Notification::where(function ($query) use ($id) {
            $query->where('notification_for',$id)->orWhereNull('notification_for');
        })->latest()->get();
        return view('client.notification.index',compact('notifications'));
    }
}
