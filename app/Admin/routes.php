<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('kategori', KategoriProdukController::class);
    $router->resource('produk', ProdukController::class);
    $router->resource('transaksions', TransaksionController::class);
    $router->get('transaksions/stokin', 'TransaksionController@index');
    

});
