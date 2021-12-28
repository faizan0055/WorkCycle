<?php

namespace App\Http\Controllers\merchant;

use App\AssignUser;
use App\Http\Controllers\Controller;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check=AssignUser::where('user_id',auth()->user()->id)->pluck('assigned_id');
        $tickets=Ticket::whereIn('user_id',$check)->get();
        return view('merchant.tickets.index',compact('tickets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function ticketUpdate(Request $request)
    {
        $stock=Ticket::find($request->id);
        $stock->answer=$request->answer;
        $stock->status='1';
        $stock->save();

        return response()->json([
            'status'=>true,
            ]);
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
    public function update(Request $request, $id )
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

    /**
     * Remove the specified resource from storage.
     *
     *  @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function shopTicketStatus(Request $request)
    {
        $ticket=Ticket::find($request->id);
        $ticket->admin_comments=$request->admin_comments;
        $ticket->status='1';
        $ticket->save();
        if($ticket){
           return response()->json([
             'status' => true
           ]);
        }
        else{
            return response()->json([
                'status' => false
            ]);
        }

    }
}
