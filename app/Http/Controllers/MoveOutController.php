<?php

namespace App\Http\Controllers;

use App\Models\Move_out;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MoveOutController extends Controller
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
     * @param  \App\Models\Move_out  $move_out
     * @return \Illuminate\Http\Response
     */
    public function show(Move_out $move_out)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Move_out  $move_out
     * @return \Illuminate\Http\Response
     */
    public function edit(Move_out $move_out)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Move_out  $move_out
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Move_out $move_out)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Move_out  $move_out
     * @return \Illuminate\Http\Response
     */
    public function destroy(Move_out $move_out)
    {
        //
    }

    public function putRequest(Request $req){
        $fields  = Validator::make($req->all(),[
            'user_id'=>'required',
            'reason'=>'required',
            'moveout_date'=>'required'
        ]);
        if($fields->fails()) {
            return response()->json([
                'status'=>422,
                'message'=>'All fields are required'
            ]);
        } else {
            try {
                $move_out = new Move_out;
                $move_out->user_id = $req->input('user_id');
                $move_out->comments = $req->input('reason');
                $move_out->date = $req->input('moveout_date');
                
                $move_out->save();
                return response()->json([
                    'status'=>200,
                    'message'=>'Success',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status'=>422,
                    'message'=>'Error',
                ]);
            }
        }
    }

    public function approveRequest(Request $req){
        try {
            $move_out_date = Move_out::where("user_id", $req->user_id)->first();
            $move_out_date->is_approved = "1";
            $move_out_date->update($req->all());
            return response()->json([
                'status'=>200,
                'message'=>'Success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>422,
                'message'=>'Error'
            ]);
        }
    }

    public function getmoveouts(){
        try {
            $events = Move_out::select('fname', 'lname', 'birth_place', 'address', 'apt_no', 'comments', 'user_role', 'is_approved',
                                        'move_outs.created_on')
                            ->join('user_accounts', 'user_accounts.user_id', '=', 'move_outs.user_id')
                            ->get();
            return response()->json([
                'status'=>200,
                'message'=>$events,
            ]);                            
        } catch (\Exception $e) {
            return response()->json([
                'status'=>422,
                'message'=>$e,
            ]);
        }
    }

}
