<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;

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

Route::view('/', 'welcome');



Route::get('database', [PeopleController::class, 'index']);
Route::resource('customers',PeopleController::class,['except'=>['index']]);
Route::post('customers', [PeopleController::class, 'search'])->name('customers.search');



