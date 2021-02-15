<?php

use Illuminate\Support\Facades\Route;

use App\Category;
use App\Reference;
use App\Product;

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
Route::group(['middleware' => ['permission:products|universal']], function () {
    Route::resource('/new','ProductController');
    Route::get('/products/new_inventory','ProductController@getNew');
    Route::post('/products/insert_categori','ProductController@postInsertCategory');
    Route::get('/products/{id}/edit','ProductController@getEdit')->name('modify');
    Route::post('/{id}/modify','ProductController@postUpdate')->name('update');
    Route::get('/products/{category}/{id}','ProductController@getProducts');
    Route::delete('{id}/delete','ProductController@delete')->name('delete');
    Route::get('/products/see_product/{category}/{id}', 'ProductController@getSeeProduct');
    Route::post('/products/{id}/sell_producto', 'ProductController@postSellProduct');
    Route::get('/products','ProductController@index')->name('products');
    Route::post('/products/{id}/print_invoice','ProductController@postInvoice');
    Route::get('/{id}/products','ProductController@getSearch')->name('search');
    
});

