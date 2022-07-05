<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\IndexController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::group(['as' => 'auth.', 'middleware' => 'guest'], function() {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

});
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('auth.logout');
Route::group(['as' => 'user.'], function() {
    Route::group(['as' => 'services.', 'prefix' => 'services'], function() {
        Route::get('/{service}', [\App\Http\Controllers\User\ServiceController::class, 'show'])->name('show');
    });
    Route::get('/profile', [IndexController::class, 'profile'])->middleware('auth')->name('profile');
    Route::delete('/{booking}/cancel', [IndexController::class, 'cancelBooking'])->middleware('auth')->name('cancel-booking');
});

Route::group(['as' => 'admin.', 'middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function() {
    Route::get('/', [IndexController::class, 'dashboard'])->name('index');
    Route::put('/', [IndexController::class, 'saveGeneralData']);
    Route::group(['as' => 'service-categories.', 'prefix' => 'service-categories'], function() {
        Route::get('/', [ServiceCategoryController::class, 'index'])->name('index');
        Route::get('/create', [ServiceCategoryController::class, 'create'])->name('create');
        Route::post('/store', [ServiceCategoryController::class, 'store'])->name('store');
        Route::get('/{serviceCategory}/edit', [ServiceCategoryController::class, 'edit'])->name('edit');
        Route::put('/{serviceCategory}/update', [ServiceCategoryController::class, 'update'])->name('update');
        Route::delete('/{serviceCategory}', [ServiceCategoryController::class, 'destroy'])->name('destroy');
    });
    Route::group(['as' => 'services.', 'prefix' => 'services'], function() {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/store', [ServiceController::class, 'store'])->name('store');
        Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('edit');
        Route::put('/{service}/update', [ServiceController::class, 'update'])->name('update');
        Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('destroy');
    });
    Route::group(['as' => 'employees.', 'prefix' => 'employees'], function() {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        Route::post('/store', [EmployeeController::class, 'store'])->name('store');
        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::put('/{employee}/update', [EmployeeController::class, 'update'])->name('update');
        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('destroy');
    });
    Route::group(['as' => 'bookings.', 'prefix' => 'bookings'], function() {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::delete('/{booking}', [BookingController::class, 'destroy'])->name('destroy');
    });
    Route::group(['as' => 'feedbacks.', 'prefix' => 'feedbacks'], function() {
        Route::get('/', [FeedbackController::class, 'index'])->name('index');
        Route::put('/{feedback}/approve', [FeedbackController::class, 'approve'])->name('approve');
        Route::delete('/{feedback}', [FeedbackController::class, 'destroy'])->name('destroy');
    });
});
