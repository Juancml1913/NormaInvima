<?php

use Illuminate\Http\Request;
use App\User;

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

Route::middleware('auth:api')->get('/user', function (Request $request, $id) {
    return $request->user();
});

Route::post('/save-subscription/{id}',function(Request $request, $id){
    $user = User::find($id);
    $user->updatePushSubscription($request->input('endpoint'), $request->input('keys.p256dh'), $request->input('keys.auth'));
    //$user->notify(new \App\Notifications\Alerta("Mensaje", "Suscribción"));
    return response()->json([
      'success' => true
    ]);
  });
  