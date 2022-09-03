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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users','UserControllerController');

Route::get('inventario/contenido', 'InventarioController@contenido');
Route::get('inventario/listarproductos', 'InventarioController@listarproductos');
Route::get('inventario/codigo_barras/{codigo}', 'InventarioController@codigo_barras');
Route::post('inventario/crear','InventarioController@crear');
Route::get('inventario/editar/{id}','InventarioController@editar');
Route::post('inventario/modificar','InventarioController@update');
Route::delete('inventario/eliminar/{id}','InventarioController@eliminar');
Route::resource('inventario','InventarioController');

///METODO DE LOS CONTEOS
//Route::get('conteo/almacenes', 'InventarioController@contenido');
Route::get('conteo/listado', 'ConteoController@listado');
Route::get('conteo/almacenes', 'ConteoController@almacenes');
Route::get('conteo/editar/{id}', 'ConteoController@editar');
Route::get('conteo/conexion/{id}', 'ConteoController@conexion');
Route::post('conteo/modificar','ConteoController@update');
Route::post('conteo/crear','ConteoController@crear');
Route::resource('conteo','ConteoController');

//RESUMENDE INVENTARIO

Route::resource('resumen','ResumenConteoController');
