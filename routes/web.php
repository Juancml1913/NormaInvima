<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('guest')->group(function () {
	//Login
    Route::get('/','UserController@indexLogin');
    Route::post('/','UserController@authenticate');
});
Route::middleware('auth')->group(function () {
    //Inicio
    Route::get('/inicio', function () {
        return view('layouts.secondLayout');
    });
    Route::get('/logout', function () {
		Auth::logout();
		return redirect('/');
	});
    
    //Usuarios
    Route::get('/usuarios','UserController@indexUser');
    Route::get('/usuarios/registrar','UserController@create');
    Route::post('/usuarios/registrar','UserController@store');
    Route::get('/usuarios/consultar','UserController@show');
    Route::get('/usuarios/consultar-usuarios','UserController@consultar');
    Route::get('/usuarios/modificar/{id}','UserController@edit');
    Route::put('/usuarios/modificar-usuario','UserController@update');
    Route::delete('/usuarios/cambiarestado/{id}','UserController@destroy');

});

