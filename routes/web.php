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
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

Route::middleware('guest')->group(function () {
	//Login
    Route::get('/','UserController@indexLogin');
    Route::post('/','UserController@authenticate');
});
Route::middleware('auth')->group(function () {
    //Inicio
    Route::get('/inicio','HomeController@index');

    Route::get('/logout', function () {
		Auth::logout();
		return redirect('/');
    });
    Route::post('/save-subscription','HomeController@guardarSuscripcion');

    //InstalacionesFisicas
    Route::get('/gestion-instalaciones-fisicas','GestionInstalacionFisicaController@index');
    Route::get('/gestion-instalaciones-fisicas/registrar','GestionInstalacionFisicaController@create');
    Route::post('/gestion-instalaciones-fisicas/registrar','GestionInstalacionFisicaController@store');
    Route::get('/gestion-instalaciones-fisicas/consultar','GestionInstalacionFisicaController@show');
    Route::get('/gestion-instalaciones-fisicas/consultar-instalaciones','GestionInstalacionFisicaController@consultar');
    Route::get('/gestion-instalaciones-fisicas/modificar/{id}','GestionInstalacionFisicaController@edit');
    Route::put('/gestion-instalaciones-fisicas/modificar-instalacion','GestionInstalacionFisicaController@update');
    Route::delete('/gestion-instalaciones-fisicas/cambiarestado/{id}','GestionInstalacionFisicaController@destroy');
    
    //Mantenimientos
    Route::get('/mantenimiento','MantenimientoController@index');
    Route::get('/mantenimiento/registrar','MantenimientoController@create');
    Route::post('/mantenimiento/registrar','MantenimientoController@store');
    Route::get('/mantenimiento/consultar','MantenimientoController@show');
    Route::get('/mantenimiento/consultar-mantenimiento','MantenimientoController@consultar');
    Route::get('/mantenimiento/modificar/{id}','MantenimientoController@edit');
    Route::post('/mantenimiento/modificar','MantenimientoController@update');
    Route::delete('/mantenimiento/eliminar/{id}','MantenimientoController@destroy');
    Route::get('/mantenimiento/ver/{id}','MantenimientoController@ver');

    //Gestión de documentos de instaciones
    Route::get('/gestion-documentos-instalaciones','GestionDocumentoInstalacionController@index');
    Route::get('/gestion-documentos-instalaciones/registrar','GestionDocumentoInstalacionController@create');
    Route::post('/gestion-documentos-instalaciones/registrar','GestionDocumentoInstalacionController@store');
    Route::get('/gestion-documentos-instalaciones/consultar','GestionDocumentoInstalacionController@show');
    Route::get('/gestion-documentos-instalaciones/consultar-documentos','GestionDocumentoInstalacionController@consultar');
    Route::get('/gestion-documentos-instalaciones/ver/{id}','GestionDocumentoInstalacionController@ver');
    Route::delete('/gestion-documentos-instalaciones/eliminar/{id}','GestionDocumentoInstalacionController@destroy');
    Route::get('/gestion-documentos-instalaciones/modificar/{id}','GestionDocumentoInstalacionController@edit');
    Route::post('/gestion-documentos-instalaciones/modificar','GestionDocumentoInstalacionController@update');

    //Indicadores
    Route::get('/indicadores','IndicadorController@index');
    Route::get('/indicadores/registrar','IndicadorController@create');
    Route::post('/indicadores/registrar','IndicadorController@store');
    Route::get('/indicadores/consultar','IndicadorController@show');
    Route::get('/indicadores/consultar-indicadores','IndicadorController@consultar');
    Route::delete('/indicadores/eliminar/{id}','IndicadorController@destroy');
    Route::get('/indicadores/ver/{id}','IndicadorController@ver');
    Route::get('/indicadores/modificar/{id}','IndicadorController@edit');
    Route::put('/indicadores/modificar/','IndicadorController@update');
    Route::get('/indicadores/imprimir/{id}','IndicadorController@imprimir');

    Route::middleware('admin')->group(function () {
      //Usuarios
      Route::get('/usuarios','UserController@indexUser');
      Route::get('/usuarios/registrar','UserController@create');
      Route::post('/usuarios/registrar','UserController@store');
      Route::get('/usuarios/consultar','UserController@show');
      Route::get('/usuarios/consultar-usuarios','UserController@consultar');
      Route::get('/usuarios/modificar/{id}','UserController@edit');
      Route::put('/usuarios/modificar-usuario','UserController@update');
      Route::delete('/usuarios/cambiarestado/{id}','UserController@destroy');
      Route::post('/usuarios/cambiarcontrasena','UserController@cambiarPassword');

      //Configuración
      Route::get('/configuracion/mantenimiento','ConfiguracionController@indexMantenimiento');
      Route::get('/configuracion/mantenimiento/registrar','ConfiguracionController@createMantenimiento');
      Route::post('/configuracion/mantenimiento/registrar','ConfiguracionController@storeMantenimiento');
      Route::get('/configuracion/mantenimiento/consultar','ConfiguracionController@showMantenimiento');
      Route::get('/configuracion/mantenimiento/consultar-mantenimiento','ConfiguracionController@consultarMantenimiento');
      Route::get('/configuracion/mantenimiento/modificar/{id}','ConfiguracionController@editMantenimiento');
      Route::post('/configuracion/mantenimiento/modificar','ConfiguracionController@updateMantenimiento');
      Route::delete('/configuracion/mantenimiento/eliminar/{id}','ConfiguracionController@destroyMantenimiento');
      Route::get('/configuracion/mantenimiento/consultar-fecha-proxima/{id_instalacion}/{fecha}','MantenimientoController@getFechaProxima');
    });
    
});

