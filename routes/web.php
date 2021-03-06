<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\GetPdfController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TemplateForPdfController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/template-for-pdf', [TemplateForPdfController::class, 'index']);

Route::get('/get-pdf', function () {
    return view('template-for-pdf-form');
});

Route::post('/get-pdf', [GetPdfController::class, 'render']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/file/{id}', [FileController::class, 'download']);

