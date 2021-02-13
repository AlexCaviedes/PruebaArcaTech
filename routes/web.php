<?php

use Illuminate\Support\Facades\Route;

use Carbon\Carbon;
use App\Categoria;
use App\Referencia;
use App\Producto;

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

Auth::routes();
Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');

// Rutas para Productos
Route::group(['middleware' => ['permission:equipos|universal']], function () {
    Route::resource('/nuevo','ProductosController');
    Route::get('/productos/nuevo_inventario','ProductosController@nuevo');
    Route::post('/productos/insertar_categoria','ProductosController@insertarCategoria');
    Route::get('/productos/editar/{id}','ProductosController@editar')->name('modificar');
    Route::post('/modificar/{id}','ProductosController@update')->name('update');
    Route::get('/productos/{categoria}/{id}','ProductosController@productos');
    Route::delete('eliminar/{id}','ProductosController@eliminar')->name('EliminarProducto');
    Route::get('/productos/ver_producto/{categoria}/{id}', 'ProductosController@verProducto');
    Route::post('/productos/vender_producto/{categoria}/{id}', 'ProductosController@venderProducto');
    Route::get('/productos','ProductosController@index')->name('productos');
    Route::post('/productos/imprimir_factura/{id}/{categoria}/{id}','ProductosController@imprimir');
    Route::get('/productos/{id}','ProductosController@busqueda')->name('busqueda'); 
});


// Rutas para Servicio Especial
Route::group(['middleware' => ['permission:servicio especial|universal']], function () {
    Route::get('/servicio-especial', 'ServicioEspecialController@index')->name('servicio-especial');
    Route::get('/servicio-especial/crear', 'ServicioEspecialController@crear');
    Route::post('/servicio-especial/create', 'ServicioEspecialController@create');
    Route::get('/servicio-especial/ver_contrato/{id}', 'ServicioEspecialController@ver_contrato')->name('ver-contrato');
});
