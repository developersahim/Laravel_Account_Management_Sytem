<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;


Route::get('/', [DashboardController::class,'index'])->name('dashboard');

Route::resource('categories', CategoryController::class)->except(['show']);
Route::resource('incomes', IncomeController::class);
Route::resource('expenses', ExpenseController::class);

Route::get('reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
Route::get('reports/monthly/pdf', [ReportController::class, 'monthlyPdf'])->name('reports.monthly.pdf');


