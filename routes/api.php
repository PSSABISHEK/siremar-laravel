<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\InspectorController;
use App\Http\Controllers\TransportBookingController;
use App\Http\Controllers\EventBookingController;
use App\Http\Controllers\MoveOutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', [UserController::class, 'getData']);
Route::post('user/signin', [UserController::class, 'signin']);
Route::post('user/register', [UserController::class, 'register']);
Route::post('user/approve', [UserController::class, 'approveUser']);
Route::post('user/getuser', [UserController::class, 'getUserDetails']);


// MASTER DISCOUNTS
Route::get('inspector/discounts-all', [InspectorController::class, 'getDiscountData']);
Route::post('inspector/adddiscount', [InspectorController::class, 'addDiscount']);
Route::post('inspector/deletediscount', [InspectorController::class, 'deleteDiscount']);
Route::post('inspector/editdiscount', [InspectorController::class, 'editDiscount']);
Route::post('inspector/discount', [InspectorController::class, 'getADiscount']);

// EVENTS
Route::get('inspector/events-all', [InspectorController::class, 'getAllEvents']);
Route::post('inspector/addevents', [InspectorController::class, 'addEvents']);
Route::post('inspector/deleteevent', [InspectorController::class, 'deleteEvent']);
Route::post('users/userevents', [EventBookingController::class, 'geteventsbooked']);


//TICKETS
Route::post('users/addtickets', [TransportBookingController::class, 'addTickets']);
Route::get('users/gettickets-all', [TransportBookingController::class, 'index']);
Route::post('users/user-ticket', [TransportBookingController::class, 'gettickets_of_user']);

//MOVEOUTS
Route::post('users/request-moveout', [MoveOutController::class, 'putRequest']);
Route::post('inspector/approve-moveout', [MoveOutController::class, 'approveRequest']);
Route::get('inspector/get-moveout', [MoveOutController::class, 'getmoveouts']);
