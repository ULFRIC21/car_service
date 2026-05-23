<?php

use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServicePageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/corporate', [PageController::class, 'corporate'])->name('pages.corporate');
Route::get('/reviews', [PageController::class, 'reviews'])->name('pages.reviews');
Route::get('/contacts', [PageController::class, 'contacts'])->name('pages.contacts');

Route::get('/uslugi/{slug}', [ServicePageController::class, 'show'])->name('services.show');

Auth::routes();

Route::redirect('/home', '/')->name('home');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::patch('clients/{user}/contacted', [AdminClientController::class, 'markContacted'])->name('clients.contacted');
    });
