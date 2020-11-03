<?php

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/pulse-for-sterling', function () {
    return view('applications.debugger-for-sterling');
})->name('debugger-for-sterling');

Route::middleware(['auth:sanctum', 'verified'])->get('/pulse-for-sterling', function () {
    return view('applications.pulse-for-sterling');
})->name('pulse-for-sterling');

Route::middleware(['auth:sanctum', 'verified'])->get('/reporting-for-sterling', function () {
    return view('applications.reporting-for-sterling');
})->name('reporting-for-sterling');
