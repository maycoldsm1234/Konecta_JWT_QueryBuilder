<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'LoginController@index')->name('/');
Route::post('login', 'LoginController@postLogin')->name('login'); // Verificar datos
Route::get('logout', 'LoginController@logout')->name('logout'); // Finalizar sesión

/*Rutas privadas solo para usuarios autenticados*/
Route::group(['middleware' => ['auth:api']], function()
{
    Route::get('/home', 'HomeController@index')->name('home'); // Vista de inicio
	
	Route::get('/usuarios', 'UsuariosController@index')->name('usuarios');  // Vista de usuario
	Route::post('/usuarios/registrar', 'UsuariosController@register')->name('usuarios/registrar'); // Registrar Usuario
	Route::post('/usuarios/editar', 'UsuariosController@edit')->name('usuarios/editar'); // Editar Usuario
	Route::post('/usuarios/eliminar', 'UsuariosController@delete')->name('usuarios/eliminar');
	
	Route::get('/clientes', 'ClientesController@index')->name('clientes');  // Vista de usuario
	Route::post('/clientes/registrar', 'ClientesController@register')->name('clientes/registrar'); // Registrar Usuario
	Route::post('/clientes/editar', 'ClientesController@edit')->name('clientes/editar'); // Editar Usuario
	Route::post('/clientes/eliminar', 'ClientesController@delete')->name('clientes/eliminar');
});

