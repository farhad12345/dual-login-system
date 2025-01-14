<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MarriageFormController;

Route::post('/marriage-form', [MarriageFormController::class, 'store']);


?>
