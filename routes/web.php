<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WikipediaController;
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
    return view('welcome');
});

Route::get('/wikipedia/{month?}/{day?}', [WikipediaController::class, 'getOnThisDay']);

Route::get ('/on-this-day/{month?}/{day?}', function () {
    return view("onthisday");
});
