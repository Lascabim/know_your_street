<?php

use App\Http\Controllers\Controller;
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

Route::get('/', [Controller::class,'welcomePage'])->name('welcome');
Route::get('/welcome', [Controller::class,'welcomePage'])->name('welcome');
Route::get('/welcome/{url}', [Controller::class, 'welcomeSearch'])->name('welcome/');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/createpost', function () {
        return view('createpost');
    })->name('createpost');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/chats', function () {
        return view('chats');
    })->name('chats');
});
