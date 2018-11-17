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
Route::get('/', 'Publica\HomeController@index')->name('home');
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.in');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('/home', 'HomeController@index')->name('admin.home');

Route::get('admin/datos_historicos/guardar', array(
    'as' => 'admin.datos_historicos.guardar',
    'uses' => 'DatosHistoricoController@guardarDatos'
));
Route::resource('admin/contactenos', 'ContactoController', ['as' => 'admin'])->except([
    'show'
]);
Route::get('admin/contactenos/data', array('as' => 'admin.contactenos.data', 'uses' => 'ContactoController@data'));

Route::middleware(['auth'])->group(function () {
    //Usuarios
    Route::resource('admin/usuarios', 'UserController', ['as' => 'admin'])->except([
        'show'
    ]);
    Route::get('admin/usuarios/data', array('as' => 'admin.usuarios.data', 'uses' => 'UserController@data'));
    Route::get('admin/usuario/perfil', array('as' => 'admin.usuario.perfil', 'uses' => 'UserController@perfil'));
    Route::post('admin/usuario/perfil', array(
        'as' => 'admin.usuario.modificar_perfil',
        'uses' => 'UserController@modificarPerfil'
    ));
    //Protocolos
    Route::resource('admin/protocolos', 'ProtocoloController', ['as' => 'admin'])->except([
        'show'
    ]);
    Route::get('admin/protocolos/data', array('as' => 'admin.protocolos.data', 'uses' => 'ProtocoloController@data'));

    //Sedes
    Route::resource('admin/sedes', 'SedeController', ['as' => 'admin'])->except([
        'show'
    ]);
    
    Route::get('admin/sedes/data', array('as' => 'admin.sedes.data', 'uses' => 'SedeController@data'));
    
    
    
    Route::get('admin/mostrar_sedes', array('as' => 'admin.sedes.mostrar', 'uses' => 'SedeController@sedesUsuario'));
    Route::post('admin/seleccionar_sede', array(
        'as' => 'admin.mostrar_sedes.seleccionar_sede', 
        'uses' => 'SedeController@seleccionarSede'
    ));

    //Datos historicos
    Route::get('admin/datos_historicos', array(
        'as' => 'admin.datos_historicos.index',
        'uses' => 'DatosHistoricoController@index'
    ));
    Route::get('admin/datos_historicos/data', array(
        'as' => 'admin.datos_historicos.data', 
        'uses' => 'DatosHistoricoController@data'
    ));

    //Enviar protocolo
    Route::get('admin/enviar_protocolo', array(
        'as' => 'admin.enviar_protocolo.index',
        'uses' => 'ControlProtocoloController@index'
    ));
    Route::get('admin/enviar_protocolo/data', array(
        'as' => 'admin.enviar_protocolo.data',
        'uses' => 'ControlProtocoloController@data'
    ));
    Route::post('admin/enviar_protocolo', array(
        'as' => 'admin.enviar_protocolo.post',
        'uses' => 'ControlProtocoloController@enviar_protocolo'
    ));

    //Historial tareas terminadas
    Route::get('admin/historial_tareas', array(
        'as' => 'admin.tareas_historial.index',
        'uses' => 'ControlProtocoloController@tareasTerminadas'
    ));
    Route::get('admin/historial_tareas/data', array(
        'as' => 'admin.tareas_historial.data',
        'uses' => 'ControlProtocoloController@tareasTerminadasData'
    ));
    //Graficas
    Route::get('admin/graficas', array(
        'as' => 'admin.graficas.index',
        'uses' => 'GraficaController@index'
    ));
    Route::post('admin/graficas/data', array(
        'as' => 'admin.graficas.data',
        'uses' => 'GraficaController@obtenerDatos'
    ));

    

    
});

Route::get('control/tareas_pendientes', 'ControlProtocoloController@enviar_tareas_pendientes');
Route::get('control/tarea_terminada/{id}', 'ControlProtocoloController@terminar_tarea');
