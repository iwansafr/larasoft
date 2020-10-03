<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryJsonController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContentJsonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserJsonController;
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

        Route::get('userjson', UserJsonController::class)->middleware('role:1');
        Route::get('categoryjson', CategoryJsonController::class);
        Route::get('contentjson', ContentJsonController::class);
        Route::get('profile/edit', [UserController::class, 'EditProfile']);
        Route::put('profile/update', [UserController::class, 'UpdateProfile']);
        Route::resource('user', UserController::class)->middleware('role:1');
        Route::resource('category', CategoryController::class);
        Route::resource('content', ContentController::class);


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
