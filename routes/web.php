<?php

use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\CallbackManageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PartController as AdminPartController;
use App\Http\Controllers\Admin\PromotionController as AdminPromotionController;
use App\Http\Controllers\Admin\ReviewModerationController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\WorkOrderController as AdminWorkOrderController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CallbackRequestController;
use App\Http\Controllers\ClientReviewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicPromotionsController;
use App\Http\Controllers\PublicReviewsController;
use App\Http\Controllers\PublicServicesController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WorkOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/services', [PublicServicesController::class, 'index'])->name('public.services');
Route::get('/promotions', [PublicPromotionsController::class, 'index'])->name('public.promotions');
Route::get('/reviews', [PublicReviewsController::class, 'index'])->name('public.reviews');
Route::get('/callback', [CallbackRequestController::class, 'create'])->name('callback.create');
Route::post('/callback', [CallbackRequestController::class, 'store'])->name('callback.store');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('vehicles', VehicleController::class);

    Route::resource('appointments', AppointmentController::class)->only(['index', 'create', 'store', 'show']);
    Route::post('appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');

    Route::get('my-work-orders', [WorkOrderController::class, 'index'])->name('work-orders.index');
    Route::get('my-work-orders/{work_order}', [WorkOrderController::class, 'show'])->name('work-orders.show');

    Route::get('my-reviews', [ClientReviewController::class, 'index'])->name('client.reviews.index');
    Route::get('my-reviews/create', [ClientReviewController::class, 'create'])->name('client.reviews.create');
    Route::post('my-reviews', [ClientReviewController::class, 'store'])->name('client.reviews.store');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('services', AdminServiceController::class)->except(['show']);

    Route::get('appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
    Route::get('appointments/{appointment}', [AdminAppointmentController::class, 'show'])->name('appointments.show');
    Route::patch('appointments/{appointment}', [AdminAppointmentController::class, 'update'])->name('appointments.update');
    Route::post('appointments/{appointment}/work-order', [AdminWorkOrderController::class, 'storeFromAppointment'])->name('appointments.work-order');

    Route::get('work-orders', [AdminWorkOrderController::class, 'index'])->name('work-orders.index');
    Route::get('work-orders/create', [AdminWorkOrderController::class, 'create'])->name('work-orders.create');
    Route::post('work-orders', [AdminWorkOrderController::class, 'store'])->name('work-orders.store');
    Route::get('work-orders/{work_order}', [AdminWorkOrderController::class, 'show'])->name('work-orders.show');
    Route::patch('work-orders/{work_order}', [AdminWorkOrderController::class, 'update'])->name('work-orders.update');
    Route::post('work-orders/{work_order}/lines', [AdminWorkOrderController::class, 'storeLine'])->name('work-orders.lines.store');
    Route::delete('work-orders/{work_order}/lines/{work_order_line}', [AdminWorkOrderController::class, 'destroyLine'])->name('work-orders.lines.destroy');
    Route::post('work-orders/{work_order}/complete', [AdminWorkOrderController::class, 'complete'])->name('work-orders.complete');

    Route::resource('parts', AdminPartController::class)->except(['show']);
    Route::resource('promotions', AdminPromotionController::class)->except(['show']);

    Route::get('callbacks', [CallbackManageController::class, 'index'])->name('callbacks.index');
    Route::patch('callbacks/{callback_request}', [CallbackManageController::class, 'update'])->name('callbacks.update');

    Route::get('reviews', [ReviewModerationController::class, 'index'])->name('reviews.index');
    Route::post('reviews/{review}/approve', [ReviewModerationController::class, 'approve'])->name('reviews.approve');
    Route::delete('reviews/{review}', [ReviewModerationController::class, 'destroy'])->name('reviews.destroy');
});
