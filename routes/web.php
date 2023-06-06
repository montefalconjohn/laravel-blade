<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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

Route::middleware(['middleware' => 'PreventBackHistory'])->group(function () {
    Auth::routes();
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth', 'PreventBackHistory']], function() {
    // Route::resource('dashboard', 'AdminController@index')->name('admin.dashboard');
    // Route::resource('profile', 'AdminController@profile')->name('admin.profile');
    // Route::resource('settings', 'AdminController@settings')->name('admin.settings');
    Route::resource('dashboard', AdminController::class, ['names' => [
        'index' => 'admin.dashboard'
    ]]);
    Route::resource('profile', AdminController::class, [
        'names' => [
            'profile' => 'admin.profile'
        ]
    ]);
    Route::resource('settings', AdminController::class, [
        'names' => [
            'settings' => 'admin.settings'
        ]
    ]);
});

Route::group(['prefix' => 'user', 'middleware' => ['isUser', 'auth', 'PreventBackHistory']], function() {
    // Route::resource('dashboard', 'UserController@index')->name('user.dashboard');
    // Route::resource('profile', 'UserController@profile')->name('user.profile');
    // Route::resource('settings', 'UserController@settings')->name('user.settings');
    Route::resource('dashboard', UserController::class, [
        'names' => [
            'index' => 'user.dashboard'
        ]
    ]);
    Route::resource('profile', UserController::class, [
        'names' => [
            'profile' => 'user.profile'
        ]
    ]);
    Route::resource('settings', UserController::class, [
        'names' => [
            'settings' => 'user.settings'
        ]
    ]);
});