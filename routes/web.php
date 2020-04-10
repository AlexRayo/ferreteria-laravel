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
    return view('welcome');
});

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::resource('productos','ProductoController');#nombreAsignado,controlador
Route::resource('ventas','VentaController');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('ventas/{id}/create', 'VentaController@create');#se crea esta ruta custome porque se necesita el id como parametro
Route::post('ventas/{id}','VentaController@update')->name('venta.update');
Route::post('productos/{id}','ProductoController@update')->name('producto.update');

#limpia cache
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return 'ROUTE CLEARED'; //Return anything
});
Route::get('/cache-clear', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    //system('composer dump-autoload');
    return 'CACHE CLEARED'; //Return anything
});



/**/

Route::get('skills', function () {
    return ['html', 'css', 'js'];
});

