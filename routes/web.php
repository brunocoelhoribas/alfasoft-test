<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PersonController;
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

Route::get('/', static function () {
    return redirect()->route('people.index');
});

Route::resource('people', PersonController::class);
Route::get('people/{person}/contacts/create', [ContactController::class, 'create'])->name('people.contacts.create');
Route::post('people/{person}/contacts', [ContactController::class, 'store'])->name('people.contacts.store');

Route::resource('contacts', ContactController::class)->except(['index', 'create', 'store']);
