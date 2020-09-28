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

    //InstalacionesFisicas
    Route::get('/gestion-instalaciones-fisicas','GestionInstalacionFisicaController@index');
    Route::get('/gestion-instalaciones-fisicas/registrar','GestionInstalacionFisicaController@create');
    Route::post('/gestion-instalaciones-fisicas/registrar','GestionInstalacionFisicaController@store');
    Route::get('/gestion-instalaciones-fisicas/consultar','GestionInstalacionFisicaController@show');
    Route::get('/gestion-instalaciones-fisicas/consultar-instalaciones','GestionInstalacionFisicaController@consultar');
    Route::get('/gestion-instalaciones-fisicas/modificar/{id}','GestionInstalacionFisicaController@edit');
    Route::put('/gestion-instalaciones-fisicas/modificar-instalacion','GestionInstalacionFisicaController@update');
    Route::delete('/gestion-instalaciones-fisicas/cambiarestado/{id}','GestionInstalacionFisicaController@destroy');

    //Gestión de documentos de instaciones
    Route::get('/gestion-documentos-instalaciones','GestionDocumentoInstalacionController@index');
    Route::get('/gestion-documentos-instalaciones/registrar','GestionDocumentoInstalacionController@create');
    Route::post('/gestion-documentos-instalaciones/registrar','GestionDocumentoInstalacionController@store');
    Route::get('/gestion-documentos-instalaciones/consultar','GestionDocumentoInstalacionController@show');
    Route::get('/gestion-documentos-instalaciones/consultar-documentos','GestionDocumentoInstalacionController@consultar');
    Route::get('/usuarios/modificar/{id}','UserController@edit');
    Route::put('/usuarios/modificar-usuario','UserController@update');
    Route::delete('/usuarios/cambiarestado/{id}','UserController@destroy');
});

