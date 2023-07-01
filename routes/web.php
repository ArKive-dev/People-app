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

Route::view('/', 'welcome')->name('home');


Route::get('database', [PeopleController::class, 'index'])->name('database');
Route::resource('people',PeopleController::class);
Route::post('people/search', [PeopleController::class, 'search'])->name('people.search');

Route::put('/people/{person}', [PeopleController::class, 'update'])->name('people.update');



