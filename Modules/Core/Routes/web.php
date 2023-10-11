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

//Route::prefix('core')->group(function() {
//    Route::get('/', 'CoreController@index');
//});


use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\HomeController;

Auth::routes();

//Route::group([
//    'middleware' => 'auth'
//], function () {
    Route::get('/', 'CoreController@index');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
//});
