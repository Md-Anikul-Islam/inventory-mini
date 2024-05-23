<?php

use App\Http\Controllers\admin\BankController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

//Admin
Route::middleware('auth')->group(callback: function () {
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Category Section
    Route::get('/category-section', [CategoryController::class, 'index'])->name('category.section');
    Route::post('/category-store', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category-update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category-delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    //Bank Section
    Route::get('/bank-section', [BankController::class, 'index'])->name('bank.section');
    Route::post('/bank-store', [BankController::class, 'store'])->name('bank.store');
    Route::put('/bank-update/{id}', [BankController::class, 'update'])->name('bank.update');
    Route::get('/bank-delete/{id}', [BankController::class, 'destroy'])->name('bank.destroy');

    //Invoice Section
    Route::get('/invoice-section', [InvoiceController::class, 'index'])->name('invoice.section');
    Route::post('/invoice-store', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('/invoice-delete/{id}', [InvoiceController::class, 'destroy'])->name('invoice.destroy');
});
require __DIR__.'/auth.php';
