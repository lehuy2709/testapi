<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


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

Route::middleware('auth', 'admin')->prefix('/users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('list'); // name : users.list
    Route::get('export', [UserController::class, 'exportUser'])->name('export'); // name : users.list

    Route::get('import', [UserController::class, 'formImport'])->name('formImport');
    Route::post('import', [UserController::class, 'storeImport'])->name('postFormImport');

    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('delete');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::put('/update-status/{user}', [UserController::class, 'update_role'])->name('update-status');
});


Route::prefix('/products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('list');
    Route::delete('/delete/{product}', [ProductController::class, 'delete'])->name('delete');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::put('/update-status/{product}', [ProductController::class, 'update_status'])->name('update-status');
    Route::get('/search', [ProductController::class, 'search'])->name('search');
});

Route::middleware('guest')->prefix('/auth')->name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'getLogin'])->name('getlogin');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('/register', [AuthController::class, 'getRegister'])->name('getRegister');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
    Route::get('/login-google',[AuthController::class,'getGoogleLogin'])->name('getGoogleLogin');
    Route::get('/google/callback',[AuthController::class,'googleLoginCallback'])->name('googleLoginCallback');
    Route::post('/create-password', [AuthController::class, 'createPapsswordForm'])->name('create-password');


});
Route::middleware('auth')->any('auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('guest', function () {
    return view('dashboard');
})->name('guest');

// Route::get('/login-google', function () {
//     return Socialite::driver('google')->redirect();
// });
// // dduowfng daanx caaus hifnh torng api
// Route::get('/google/callback', function () {
//     dd(Socialite::driver('google')->user());
// });

