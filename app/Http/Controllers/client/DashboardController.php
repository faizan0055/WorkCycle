<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Question;
use App\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $news=Question::latest()->first();
        return view('client.home',compact('news'));
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

    public function notifications(){
        $notifications = Notification::where('notice_for','0')->Orwhere('notice_for','1')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->latest()->get();
        $count = $notifications->count();
        $new = false;
        foreach ($notifications as $key => $value) {
            $value['time'] = \Carbon\Carbon::parse($value->created_at)->diffForhumans();
            $time = Carbon::parse($value->created_at)->diffInSeconds();
            if($time < 10){
                $new = true;
            }

        }
        return response()->json([
            'status'=>true,
            'notifications'=>$notifications,
            'count'=>$count,
            'new'=>$new
        ]);
    }
}
