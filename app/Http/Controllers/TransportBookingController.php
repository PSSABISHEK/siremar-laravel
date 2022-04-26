<?php

namespace App\Http\Controllers;

use App\Models\Transport_booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransportBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Transport_booking::all();
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
     * @param  \App\Models\Transport_booking  $transport_booking
     * @return \Illuminate\Http\Response
     */
    public function show(Transport_booking $transport_booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transport_booking  $transport_booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Transport_booking $transport_booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transport_booking  $transport_booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transport_booking $transport_booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transport_booking  $transport_booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transport_booking $transport_booking)
    {
        //
    }

    public function addTickets(Request $req) {
        $fields  = Validator::make($req->all(),[
            'user_id'=>'required',
            'transport_type'=>'required',
            'source'=>'required',
            'destination'=>'required',
            'time'=>'required'
        ]);

        if($fields->fails()) {
            return response()->json([
                'status'=>422,
                'message'=>'All fields are required'
            ]);
        } else {
            $transport = new Transport_booking;
            $transport->user_id = $req->input('user_id');
            $transport->transport_id = $req->input('transport_id');
            $transport->type = $req->input('transport_type');
            $transport->source = $req->input('source');
            $transport->destination = $req->input('destination');
            $transport->time = $req->input('time');
            $transport->save();
            return response()->json([
                'status'=>200,
                'message'=>'Success',
            ]);
        }
    }

    public function gettickets_of_user(Request $req){
        $user_tickets = Transport_booking::where(["user_id"=> $req->user_id, "type"=>$req->transport_type])->get();
        if (count($user_tickets) > 0) {
            return response()->json([
                'status'=>200,
                'message'=>$user_tickets,
            ]);
        } else {
            return response()->json([
                'status'=>422,
                'message'=>'No data found',
            ]);
        }
    }

    public function gettickets(Request $req){
        $user_tickets = Transport_booking::where(["type"=>$req->transport_type])->get();
        if (count($user_tickets) > 0) {
            return response()->json([
                'status'=>200,
                'message'=>$user_tickets,
            ]);
        } else {
            return response()->json([
                'status'=>422,
                'message'=>'No data found',
            ]);
        }
    }

}
