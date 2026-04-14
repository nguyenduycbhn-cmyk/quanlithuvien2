<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\UserController; // 🔥 thêm dòng này
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/home', function(){
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function(){

    // 📊 Dashboard
    Route::get('/dashboard', [BookController::class, 'dashboard']);

    // 📚 Sách
    Route::get('/', [BookController::class, 'index']);
    Route::get('/create', [BookController::class, 'create']);
    Route::post('/store', [BookController::class, 'store']);
    Route::get('/edit/{id}', [BookController::class, 'edit']);
    Route::post('/update/{id}', [BookController::class, 'update']);
    Route::get('/delete/{id}', [BookController::class, 'destroy']);

    // 📖 Mượn trả
    Route::get('/borrow', [BorrowController::class, 'index']);
    Route::get('/borrow/create', [BorrowController::class, 'create']);
    Route::post('/borrow/store', [BorrowController::class, 'store']);
    Route::get('/borrow/return/{id}', [BorrowController::class, 'returnBook']);

    // 👤 THÀNH VIÊN (MỚI THÊM)
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users/store', [UserController::class, 'store']);
    Route::get('/users/delete/{id}', [UserController::class, 'destroy']);
});