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
Route::get('/', function () {
    return redirect()->route('login');
});
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
