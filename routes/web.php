<?php

use App\Livewire\StripeComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\Entryform;
use App\Livewire\CartPage;
use App\Http\Controllers\StripeController\checkout;
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

Route::get('/entry', Entryform::class)->name('entryform');
Route::get('/entry/{id}', Entryform::class)->name('entryform');
Route::post('checkout', CartPage::class)->name('checkout');
Route::get('/cart', CartPage::class)->name('cart');

require __DIR__.'/auth.php';
