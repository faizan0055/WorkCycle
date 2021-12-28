<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function EcomDashboard()
    {
        return view('admin.ecommerce.dashboard');
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

    public function ticketsNotifications(){
        $tickets = Ticket::where('status','0')->with('users')->latest()->get();
        $count = $tickets->count();
        $new = false;
        foreach ($tickets as $key => $value) {
            $value['type'] = ucfirst($value->user_type);
            $value['time'] = Carbon::parse($value->created_at)->diffForhumans();
            $time = Carbon::parse($value->created_at)->diffInSeconds();
            if($time < 10){
                $new = true;
            }

        }
        return response()->json([
            'status'=>true,
            'tickets'=>$tickets,
            'count'=>$count,
            'new'=>$new
        ]);
    }
}
