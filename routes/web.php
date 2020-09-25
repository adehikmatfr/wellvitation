<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$api = app('Dingo\Api\Routing\Router');


// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$api->version('v1', function ($api) {
    // auth
    $api->post('/register', 'App\Http\Controllers\AuthController@register');
    $api->post('/login', 'App\Http\Controllers\AuthController@login');
    $api->get('/user', 'App\Http\Controllers\AuthController@user');
    $api->get('/test', 'App\Http\Controllers\AuthController@test');

    // roles
    $api->get('/roles', 'App\Http\Controllers\RoleController@index');
    $api->get('/roles/{id}', 'App\Http\Controllers\RoleController@findId');
    $api->post('/roles', 'App\Http\Controllers\RoleController@store');
    $api->patch('/roles/{id}', 'App\Http\Controllers\RoleController@update');
    $api->delete('/roles/{id}', 'App\Http\Controllers\RoleController@delete');

    // roles
    $api->get('/brides', 'App\Http\Controllers\BrideController@index');
    $api->get('/brides/{id}', 'App\Http\Controllers\BrideController@findId');
    $api->post('/brides', 'App\Http\Controllers\BrideController@store');
    $api->patch('/brides/{id}', 'App\Http\Controllers\BrideController@update');
    $api->delete('/brides/{id}', 'App\Http\Controllers\BrideController@delete');

    // products
    $api->get('/products', 'App\Http\Controllers\ProductController@index');
    $api->get('/products/{id}', 'App\Http\Controllers\ProductController@findId');
    $api->post('/products', 'App\Http\Controllers\ProductController@store');
    $api->patch('/products/{id}', 'App\Http\Controllers\ProductController@update');
    $api->delete('/products/{id}', 'App\Http\Controllers\ProductController@delete');

    // voucher
    $api->get('/vouchers', 'App\Http\Controllers\VoucherController@index');
    $api->get('/vouchers/{id}', 'App\Http\Controllers\VoucherController@findId');
    $api->post('/vouchers', 'App\Http\Controllers\VoucherController@store');
    $api->patch('/vouchers/{id}', 'App\Http\Controllers\VoucherController@update');
    $api->delete('/vouchers/{id}', 'App\Http\Controllers\VoucherController@delete');

    // description
    $api->get('/descriptions', 'App\Http\Controllers\DescriptionController@index');
    $api->get('/descriptions/{id}', 'App\Http\Controllers\DescriptionController@findId');
    $api->post('/descriptions', 'App\Http\Controllers\DescriptionController@store');
    $api->patch('/descriptions/{id}', 'App\Http\Controllers\DescriptionController@update');
    $api->delete('/descriptions/{id}', 'App\Http\Controllers\DescriptionController@delete');

    // Order
    $api->get('/orders', 'App\Http\Controllers\OrderController@index');
    $api->get('/orders/{id}', 'App\Http\Controllers\OrderController@findId');
    $api->post('/orders', 'App\Http\Controllers\OrderController@store');
    $api->patch('/orders/{id}', 'App\Http\Controllers\OrderController@update');
    $api->delete('/orders/{id}', 'App\Http\Controllers\OrderController@delete');
    // 
    $api->post('/payment/notification', 'App\Http\Controllers\PaymentController@notification');
    $api->get('/payment/completed', 'App\Http\Controllers\PaymentController@completed');
    $api->post('/payment/failed', 'App\Http\Controllers\PaymentController@failed');
});
