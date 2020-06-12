<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Auth::routes();

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api']], function (Router $router) {
    // TODO: Requests without authentication

    // TODO: Requests with authentication
    $router->middleware('authorized')->group(function (Router $router) {
        $router->resource('categories', 'ProductTypesController');
        $router->get('products/minimized', 'ProductsController@minimized')->name('products.index.minimized');
        $router->resource('products', 'ProductsController')->only(['index', 'show']);
        $router->resource('orders', 'OrdersController');
        $router->resource('tables', 'TablesController');
        $router->resource('offers', 'OffersController');

        // TODO: Requests with admin authentication
        $router->middleware('isAdmin')->group(function (Router $router) {
            $router->resource('users', 'UserController')->only(['index', 'store', 'update', 'destroy']);
            $router->resource('products', 'ProductsController')->only(['update', 'store', 'destroy']);
        });
    });
});
