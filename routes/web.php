<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;

// Home page = list of books
Route::get('/', [BookController::class, 'index'])->name('home');

// Resource routes for books (CRUD)
Route::resource('books', BookController::class);

// Borrow / return routes
Route::get('/borrows', [BorrowController::class, 'index'])->name('borrows.index');
Route::get('/borrows/create', [BorrowController::class, 'create'])->name('borrows.create');
Route::post('/borrows', [BorrowController::class, 'store'])->name('borrows.store');
Route::post('/borrows/{borrow}/return', [BorrowController::class, 'returnBook'])->name('borrows.return');
