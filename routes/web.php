<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
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
Route::get('/',[IndexController::class, 'index']);

Route::get('/hello',[IndexController::class, 'show'])->middleware('auth');

/* Middleware run before the controller action and in case of
the listing resours we want not applly to all route but to specfic route.
middleware('auth') athenticate our app routes.

for this reason we use recourse with except function again.
*/
Route::resource('listing', ListingController::class)
->only(['create', 'store','edit', 'update', 'destroy'])
->middleware('auth');
Route::resource('listing', ListingController::class)
  ->except(['create', 'store', 'edit', 'update', 'destroy']);
  
Route::get('login', [AuthController::class, 'create']) -> name('login');

Route::post('login', [AuthController::class, 'store']) -> name('login.store');

Route::delete('logout', [AuthController::class, 'destroy']) -> name('logout');