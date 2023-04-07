<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SwoogoApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::controller(SwoogoApiController::class)->group(function(){
    Route::get('get_event', 'getEvent');
    Route::get('get_event_sessions', 'getEventSessions');
    Route::get('get_event_tracks', 'getEventTracks');
    //more related api routes 
});
