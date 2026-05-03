<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

// redirect sau login
Route::get('/home', function(){
    return redirect('/dashboard');
});

// 📚 Trang chủ
Route::get('/', [BookController::class, 'index'])->name('books.index');

Route::middleware(['auth'])->group(function(){

    // 📊 Dashboard
    Route::get('/dashboard', [BookController::class, 'dashboard'])->name('dashboard');

    // 📚 SÁCH
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::post('/books/update/{id}', [BookController::class, 'update'])->name('books.update');
    Route::get('/books/delete/{id}', [BookController::class, 'destroy'])->name('books.delete');

    // 📖 MƯỢN TRẢ (🔥 FIX NAME)
    Route::get('/borrow', [BorrowController::class, 'index'])->name('borrow.index');
    Route::get('/borrow/create', [BorrowController::class, 'create'])->name('borrow.create');

    // 🔥 FIX QUAN TRỌNG
    Route::post('/borrow/store', [BorrowController::class, 'store'])->name('borrow.store');

    Route::get('/borrow/return/{id}', [BorrowController::class, 'returnBook'])->name('borrow.return');

    // 👤 THÀNH VIÊN
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
});