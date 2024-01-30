<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Entryform;
use App\Livewire\CartPage;

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

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/entry', Entryform::class)->middleware(['auth'])->name('entry');

Route::get('/cart', CartPage::class);


require __DIR__.'/auth.php';
