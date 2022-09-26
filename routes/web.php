<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PaymentController;

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



Route::group(['prefix' => 'admin', 'middleware' => ['can:create-users']], function(){
    Route::get('/', AdminController::class)->name('admin.index');
    Route::resource('users', UserController::class);
});


Route::get('/account', [BusinessController::class, 'checkAccount'])->middleware('auth')->name('account');
Route::group(['middleware' => ['can:top-up-account']], function(){
    Route::post('/top-up-account', [BusinessController::class, 'topUpAccount'])->name('top-up-account');
    Route::post('/send-bonuses', [BusinessController::class, 'sendBonuses'])->name('send-bonuses');
});

Route::post('/callback', [BusinessController::class, 'payCallback']);




Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::get('/logout', [SessionController::class, 'logout'])->name('logout');
Route::post('/login', [SessionController::class, 'login']);
