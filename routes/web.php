<?php

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
    return redirect(route('login'));
});

Auth::routes([
    'register' => false,
]);

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', App\Http\Livewire\DashboardAdministrator::class)
        ->name('home');

    Route::get('item', App\Http\Livewire\ItemAdministrator::class)
        ->name('item');

    Route::get('item/{id}', App\Http\Livewire\ItemViewAdministrator::class)
        ->name('itemview');

    Route::get('pengelolaan', App\Http\Livewire\PengelolaanAdministrator::class)
        ->name('pengelolaan');

    Route::get('report', App\Http\Livewire\ReportAdministrator::class)
        ->name('report');
});
