<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\StripeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemsController;
use \App\Http\Middleware\EnsureTokenIsValid;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//:sanctum

/**
 * Routes without auth
 */
Route::post('login', [AuthController::class, 'login']);
Route::post('/registerUser', [UserController::class, 'registerUser']);


Route::middleware([EnsureTokenIsValid::class])->group(function () {

    Route::middleware('auth')->get('/user', function (Request $request) {
        return $request->user();
    });

    /**
     * Profile routes
     */
    Route::post('me', [AuthController::class, 'me']);
    Route::post('logout',[AuthController::class, 'logout']);
    Route::post('refresh',[AuthController::class, 'refresh']);

    /**
     * User routes
     */
    Route::get('/getAllUsers', [UserController::class, 'getAllUsers']);
    Route::get('/getUser/{user}', [UserController::class, 'getUser']);
    Route::post('/createUser', [UserController::class, 'createUser']);
    Route::patch('/updateUser/{user}', [UserController::class, 'updateUser']);
    Route::delete('/deleteUser/{user}', [UserController::class, 'deleteUser']);

    /**
     * Order routes
     */
    Route::get('/getAllOrders', [OrderController::class, 'getAllOrders']);
    Route::get('/getOrder/{order}', [OrderController::class, 'getOrder']);
    Route::post('/createOrder', [OrderController::class, 'createOrder']);
    Route::patch('/updateOrder/{order}', [OrderController::class, 'updateOrder']);
    Route::delete('/deleteOrder/{order}', [OrderController::class, 'deleteOrder']);


    Route::get('/getAllroles', [RoleController::class, 'getAllroles']);
    Route::get('/getroles/{role}', [RoleController::class, 'getroles']);
    Route::post('/createroles', [RoleController::class, 'createroles']);
    Route::patch('/updateroles/{role}', [RoleController::class, 'updateroles']);
    Route::delete('/deleteroles/{role}', [RoleController::class, 'deleteroles']);


    Route::get('/getAllItems', [ItemsController::class, 'getAllItems']);
    Route::get('/getItemById/{item}', [ItemsController::class, 'getItem']);
    Route::post('/createItem', [ItemsController::class, 'createItem']);
    Route::patch('/updateItem/{item}', [ItemsController::class, 'updateItem']);
    Route::delete('/deleteItem/{item}', [ItemsController::class, 'deleteItem']);

});


Route::post('stripe', [StripeController::class, 'stripe']);

