<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\UserController;

Auth::routes();

/*
|--------------------------------------------------------------------------
| REDIRECT SAU LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/home', function () {
    return redirect('/dashboard');
});

/*
|--------------------------------------------------------------------------
| TRANG CHỦ
|--------------------------------------------------------------------------
*/

Route::get('/', [BookController::class, 'index'])
    ->name('books.index');

/*
|--------------------------------------------------------------------------
| ROUTE CẦN LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [BookController::class, 'dashboard'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | QUẢN LÝ SÁCH
    |--------------------------------------------------------------------------
    */

    Route::get('/books/create', [BookController::class, 'create'])
        ->name('books.create');

    Route::post('/books/store', [BookController::class, 'store'])
        ->name('books.store');

    Route::get('/books/edit/{id}', [BookController::class, 'edit'])
        ->name('books.edit');

    Route::post('/books/update/{id}', [BookController::class, 'update'])
        ->name('books.update');

    Route::get('/books/delete/{id}', [BookController::class, 'destroy'])
        ->name('books.delete');

    /*
    |--------------------------------------------------------------------------
    | MƯỢN TRẢ SÁCH
    |--------------------------------------------------------------------------
    */

    Route::get('/borrow', [BorrowController::class, 'index'])
        ->name('borrows.index');

    Route::get('/borrow/create', [BorrowController::class, 'create'])
        ->name('borrows.create');

    Route::post('/borrow/store', [BorrowController::class, 'store'])
        ->name('borrows.store');

    Route::get('/borrow/return/{id}', [BorrowController::class, 'returnBook'])
        ->name('borrows.return');

    /*
    |--------------------------------------------------------------------------
    | THÀNH VIÊN
    |--------------------------------------------------------------------------
    */

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create');

    Route::post('/users/store', [UserController::class, 'store'])
        ->name('users.store');

    Route::get('/users/edit/{id}', [UserController::class, 'edit'])
        ->name('users.edit');

    Route::put('/users/update/{id}', [UserController::class, 'update'])
        ->name('users.update');

    Route::get('/users/delete/{id}', [UserController::class, 'destroy'])
        ->name('users.delete');

    Route::get('/users/change-password', [UserController::class, 'changePasswordForm'])
        ->name('users.change-password');
    Route::post('/users/change-password', [UserController::class, 'changePassword'])
        ->name('users.change-password.post');
});