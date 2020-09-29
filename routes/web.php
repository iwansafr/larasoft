<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/', function () {
            return view('page.index');
        });
        Route::get('/user/list', [UserController::class, 'list'])->middleware('role:1');
        Route::get('/user/edit/{number}', [UserController::class, 'edit']);
        Route::get('/profile/edit/', [UserController::class, 'edit']);
        Route::post('/profile/edit/', [UserController::class, 'edit']);
        Route::post('/user/save', [UserController::class, 'save']);

        Route::get('/forbidden', function () {
            return view('page.forbidden', ['status' => 'danger', 'title' => '404', 'msg' => 'You Dont Have Permission to Access This Page']);
        })->name('forbidden');
    });
});

Route::get('register', [RegisterController::class, 'register']);
Route::post('register', [RegisterController::class, 'store']);

Route::get('login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
