<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\oppointments\OppintmentController;

//this routes for المواعيد
Route::get('/almawayeed/login', [OppintmentController::class, 'loginForm'])->name('almawayeed.login');
Route::post('/almawayeed/save/login', [OppintmentController::class, 'login'])->name('almawayeed.save.login');
Route::post('/almawayeed/logout', [OppintmentController::class, 'logout'])->name('almawayeed.logout');
Route::get('/almawayeed/register', [OppintmentController::class, 'Registerform'])->name('almawayeed.register');
Route::post('/almawayeed/register', [OppintmentController::class, 'RegisterStore'])->name('almawayeed.register');
Route::middleware(['mawayeedauth'])
    ->prefix('almawayeed')
    ->as('almawayeed.')
    ->group(function () {
        Route::get('/dashboard', [OppintmentController::class, 'Dashboard'])->name('dashboard');
        Route::get('/almawayeed/edit/{id}', [OppintmentController::class, 'edit'])->name('edit');
        Route::PUT('/almawayeed/update/{id}', [OppintmentController::class, 'AlmawayeedProjectUpdate'])->name('update');
        Route::DELETE('/almawayeed/destroye/{id}', [OppintmentController::class, 'WahajProjectDestroy'])->name('destroy');

        Route::get('/almawayeed/create', [OppintmentController::class, 'Create'])->name('create');


        Route::post('/project/store', [OppintmentController::class, 'almawayeedStore'])->name('project.store');

    });
    Route::get('/get/maveed_prevoius_data/list', [DashboardController::class, 'GetMaveedPrevoisuListData'])->name('maveed.prevoius.data');
    Route::get('/get/maveed_prevoius_data/user/list', [OppintmentController::class, 'GetMaveedPrevoisuListData'])->name('maveed.user.prevoius.data');
