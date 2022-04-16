<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\BookController;

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

// Clear Cache

Route::get('clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return "Cleared!";
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('home');
Route::get('home', [App\Http\Controllers\Auth\LoginController::class, 'index']);


Route::get('forgot-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showPasswordResetForm'])->name('resetpasswordform');
Route::post('resetpasswordemail', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPasswordSendEmail'])->name('resetpasswordemail');
Route::post('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPassword'])->name('passwordreset');

Route::get('404notfound', [App\Http\Controllers\admin\HomeController::class, 'notFound'])->name('404notfound');
Route::get('500error', [App\Http\Controllers\admin\HomeController::class, 'exceptions'])->name('500error');
Route::get('401unauthorized', [App\Http\Controllers\admin\HomeController::class, 'unauthorized'])->name('401unauthorized');



Route::middleware(['auth'])->group(function (){

    /* Admin */
    Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

        Route::group(['prefix' => 'admin','namespace' => 'admin'], function() {

            Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

            /* My profile */
            Route::get('myprofile', [UserController::class, 'myProfile'])->name('myprofile');
            Route::post('updatemyprofile', [UserController::class, 'updateMyProfile'])->name('updatemyprofile');

            /* Change Password */
            Route::get('change-password', [UserController::class, 'chnagePassword'])->name('change-password');
            Route::post('change-password', [UserController::class, 'storeChangePassword'])->name('change.password');

            /* User Section */
            Route::get('user/index', [UserController::class, 'index'])->name('user.index');
            Route::get('user/create', [UserController::class, 'create'])->name('user.create');
            Route::post('user/store', [UserController::class, 'store'])->name('user.store');
            Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::patch('user/update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');
            Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

            Route::post('getusers', [UserController::class, 'postUsersList'])->name('getusers');
            Route::post('userresetpassword', [UserController::class, 'postResetUserPassword'])->name('userresetpassword');


            /* Book Section */
            Route::get('book/index', [BookController::class, 'index'])->name('book.index');
            Route::get('book/store', [BookController::class, 'store'])->name('book.store');
            Route::get('book/{id}', [BookController::class, 'show'])->name('book.show');

            Route::post('getbooks', [BookController::class, 'postBooksList'])->name('getbooks');
        });

});
