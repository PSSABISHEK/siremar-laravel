<?php

namespace App\Http\Controllers;

use App\Models\Event_booking;
use Illuminate\Http\Request;

class EventBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Event_booking  $event_booking
     * @return \Illuminate\Http\Response
     */
    public function show(Event_booking $event_booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event_booking  $event_booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Event_booking $event_booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event_booking  $event_booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event_booking $event_booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event_booking  $event_booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event_booking $event_booking)
    {
        //
    }

    public function geteventsbooked(Request $req){
        try {
            $events = Event_booking::select('name', 'date', 'time', 'address')
                            ->join('event_list', 'event_list.event_id', '=', 'event_bookings.event_id')
                            ->where('event_bookings.user_id', $req->user_id)
                            ->get();
            return response()->json([
                'status'=>200,
                'message'=>$events,
            ]);                            
        } catch (\Exception $e) {
            return response()->json([
                'status'=>422,
                'message'=>"Error",
            ]);
        }
    }

}
