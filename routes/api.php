<?php

use Illuminate\Http\Request;
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

use App\Http\Controllers\DummyDataController;  //api to add dummy data to users and product tables for task1 question number 6
 
Route::post('seed/users', [DummyDataController::class, 'seedUsers'])->middleware('auth');
Route::post('seed/products', [DummyDataController::class, 'seedProducts'])->middleware('auth');


use App\Http\Controllers\RatingController; // task2 question 1

Route::prefix('ratings')->group(function () {
    Route::post('/rate/{productId}', [RatingController::class, 'rateProduct'])->middleware('auth');  //rating product  task 2 item 5
    Route::delete('/remove/{productId}', [RatingController::class, 'removeRating'])->middleware('auth');  //remove product  task 2 item 5
    Route::put('/change/{productId}', [RatingController::class, 'changeRating'])->middleware('auth');  //change product  task 2 item 5
});


use App\Http\Controllers\ProductController;  //display list of products

Route::get('/products', [ProductController::class, 'index'])->middleware('auth');



use App\Http\Controllers\AuthController;   //login endpoint in normal working project i should use  install laravel passport  in  User model, i added the HasApiTokens trait to enable API token generation for users: for (BONUS TASK) Authentication
Route::post('/login', [AuthController::class, 'login']);


//i have added middleware('auth') to authorise each endpoint except the login endpoint in normal working project i should run php artisan make:middleware Authenticate to activate the authentication
