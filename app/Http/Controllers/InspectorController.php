<?php

namespace App\Http\Controllers;

use App\Models\Master_discount;
use App\Models\Event_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InspectorController extends Controller
{
    
    // DISCOUNT CONTROLLER
    function getDiscountData(){
        return response()->json([
            'status'=>200,
            'message'=>Master_discount::all()
        ]);
    }

    public function addDiscount(Request $req) {
        $fields  = Validator::make($req->all(),[
            'discount_code'=>'required',
            'events_rate'=>'required',
            'ferry_rate'=>'required',
            'flight_rate'=>'required',
            'school_rate'=>'required',
            'clinic_rate'=>'required'
        ]);

        if($fields->fails()) {
            return response()->json([
                'status'=>422,
                'message'=>'All fields are required'
            ]);
        } else {
            $discount = new Master_discount;
            $discount->name = $req->input('discount_code');
            $discount->events_rate = $req->input('events_rate');
            $discount->ferrys_rate = $req->input('ferry_rate');
            $discount->flights_rate = $req->input('flight_rate');
            $discount->clinics_rate = $req->input('clinic_rate');
            $discount->schools_rate = $req->input('school_rate');
            $discount->save();
            return response()->json([
                'status'=>200,
                'message'=>'Success',
            ]);
        }
    }

    public function deleteDiscount(Request $req){
        $result = Master_discount::where('id', $req->dicount_id)->first();
     
        if($result)
        {
            $result->delete();
            return response()->json([
                'status'=>200,
                'message'=>"Success",
            ]);
        }
        else {
            return response()->json([
                'status'=>404,
                'message'=>'Error'
            ]);
        }
    }

    public function discount_details($discount_id) {
        $discount = array();
        if ($discount_id != "") {
            $discount = Master_discount::where("id", $discount_id)->first();
            return $discount;
        }
    }

    public function editDiscount(Request $req) {
        try {
            // $req = array_filter($req->all());
            $discount = $this->discount_details($req->discount_id);
            $discount->name = $req->input('discount_code');
            $discount->events_rate = $req->input('events_rate');
            $discount->ferrys_rate = $req->input('ferry_rate');
            $discount->flights_rate = $req->input('flight_rate');
            $discount->clinics_rate = $req->input('clinic_rate');
            $discount->schools_rate = $req->input('school_rate');
            $discount->update(array_filter($req->all()));
            return response()->json([
                'status'=>200,
                'message'=>'Success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>422,
                'message'=>"Error"
            ]);
        }
    }

    public function getADiscount(Request $req) {
        $discount = Master_discount::where("name", $req->coupon_name)->first();
        if ($discount) {
            if ($req->business_type == "events"){
                $percentage = $discount->events_rate;
            } else if ($req->business_type == "ferrys") {
                $percentage = $discount->ferrys_rate;
            } else if ($req->business_type == "flights") {
                $percentage = $discount->flights_rate;
            } else if ($req->business_type == "clinics") {
                $percentage = $discount->clinics_rate;
            } else if ($req->business_type == "schools") {
                $percentage = $discount->schools_rate;
            }
        }
        return response()->json([
            'status'=>200,
            'message'=> $percentage
        ]);
    }

    // EVENTS

    public function addEvents(Request $req) {
        $fields  = Validator::make($req->all(),[
            'event_id'=>'required',
            'event_name'=>'required',
            'date'=>'required',
            'discount_rate'=>'required',
            'address'=>'required',
            'time'=>'required'
        ]);

        if($fields->fails()) {
            return response()->json([
                'status'=>422,
                'message'=>'All fields are required'
            ]);
        } else {
            $events = new Event_list;
            $events->event_id = $req->input('event_id');
            $events->name = $req->input('event_name');
            $events->address = $req->input('address');
            $events->time = $req->input('time');
            $events->discount_rate = $req->input('discount_rate');
            $events->date = $req->input('date');
            $events->save();
            return response()->json([
                'status'=>200,
                'message'=>'Success',
            ]);
        }
    }

    public function deleteEvent(Request $req){
        $result = Event_list::where('event_id', $req->event_id)->first();
     
        if($result)
        {
            $result->delete();
            return response()->json([
                'status'=>200,
                'message'=>"Success",
            ]);
        }
        else {
            return response()->json([
                'status'=>404,
                'message'=>'Error'
            ]);
        }
    }

    function getAllEvents(){
        return response()->json([
            'status'=>200,
            'message'=>Event_list::all()
        ]);
    }

    // 

}
