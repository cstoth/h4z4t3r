<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CronController;

/*
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('cron/index', [CronController::class, 'index'])->name('cron.index');
Route::get('cron/hunter', [CronController::class, 'hunter'])->name('cron.hunter');
