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

    // Requests without authentication
    $router->get('/productTypes', 'ProductTypesController@index');
    $router->get('/pdf', 'ProductsController@generatePDF');
    $router->post('/order', 'OrdersController@storeTakeout');
    $router->resource('products', 'ProductsController')->only(['index', 'show']);
    $router->resource('categories', 'ProductTypesController')->only(['index']);

    // Requests with authentication
    $router->middleware('authorized')->prefix('admin')->group(function (Router $router) {
        $router->resource('tables', 'TablesController')->only(['index', 'show']);

        // Requests with admin authentication
        $router->middleware('isAdmin')->group(function (Router $router) {
            $router->resource('users', 'UserController')->only(['index', 'store', 'update', 'destroy']);
            $router->resource('products', 'ProductsController')->only(['update', 'store', 'destroy']);
            $router->resource('orders', 'OrdersController')->only(['index', 'show']);
            $router->resource('tables', 'TablesController')->only(['store']);
            $router->resource('sales', 'SalesController')->only(['index']);
        });

        // Requests with cashier authentication
        $router->middleware('isCashier')->group(function (Router $router) {
            $router->resource('orders', 'OrdersController')->only(['store']);
            $router->resource('tables', 'TablesController')->only(['update']);
            $router->resource('offers', 'OffersController');
            $router->get('products/minimized', 'ProductsController@minimized')->name('products.index.minimized');
        });
    });
});
