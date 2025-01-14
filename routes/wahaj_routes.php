<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\wahajwatan\WahajController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
//this routes for وهج وطن
Route::get('/wahajwatan/login', [WahajController::class, 'loginForm'])->name('wahajwatan.login');
Route::post('/wahajwatan/save/login', [WahajController::class, 'login'])->name('wahajwatan.save.login');
Route::post('/wahajuser/logout', [WahajController::class, 'logout'])->name('wahajuser.logout');
Route::get('/wahajwatan/register', [WahajController::class, 'Registerform'])->name('wahajwatan.register');
Route::post('/wahajwatan/register', [WahajController::class, 'RegisterStore'])->name('wahajwatan.register');
Route::middleware(['wahajauth'])
    ->prefix('wahajwatan')
    ->as('wahajwatan.')
    ->group(function () {
        Route::get('/dashboard', [WahajController::class, 'Dashboard'])->name('dashboard');
        Route::get('/wahajwatan/edit/{id}', [WahajController::class, 'edit'])->name('edit');
        Route::PUT('/wahajwatan/update/{id}', [WahajController::class, 'wahajwatanrojectUpdate'])->name('update');
        Route::DELETE('/wahajwatan/destroye/{id}', [WahajController::class, 'wahajwatanProjectDestroy'])->name('destroy');
        Route::get('/wahajwatan/create', [WahajController::class, 'Create'])->name('create');


        Route::post('/project/store', [WahajController::class, 'WahajStore'])->name('project.store');

    });




