<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MarriageFormController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test-email', function () {
    Mail::raw('This is a test email.', function ($message) {
        $message->to('farhadkhanfarhad367@gmail.com')
                ->subject('Test Email');
    });
    return 'Email sent!';
});
Route::post('/marriage-form', [MarriageFormController::class, 'store']);
Route::get('/marriage-form', [MarriageFormController::class, 'show']);

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/admin/projects/destroy/{id}', [DashboardController::class, 'destroy'])->name('admin.projects.destroy');
    Route::get('/admin/projects/create', [DashboardController::class, 'ProjectCreate'])->name('admin.projects.create');
    Route::post('/admin/projects/store', [DashboardController::class, 'ProjectStore'])->name('admin.projects.store');
    Route::get('/admin/projects/edit/{id}', [DashboardController::class, 'ProjectEdit'])->name('admin.projects.edit');
    Route::put('/admin/projects/update/{id}', [DashboardController::class, 'ProjectUpdate'])->name('admin.projects.update');

    Route::get('/admin/view-projects/{id}', [DashboardController::class, 'ViewProjects'])->name('admin.view-projects');
    Route::get('/admin/user/destroy/{id}', [DashboardController::class, 'UserDelete'])->name('admin.user.destroy');

    Route::get('/admin/company-details/{id}', [DashboardController::class, 'CompanyDetails'])->name('admin.company-details');
    Route::get('admin/add-employee', action: [DashboardController::class, 'Employecreate'])->name('admin.add.employee');
    Route::post('admin/store-employee', action: [DashboardController::class, 'EmployeStore'])->name('admin.employee.store');
    Route::get('admin/users', action: [DashboardController::class, 'UsersList'])->name('admin.users.lists');

    Route::get('admin/users/destroy/{id}', action: [DashboardController::class, 'UserDelete'])->name('admin.users.destroy');
    Route::post('/admin/user/status/edit/{id}', [DashboardController::class, 'UpdateUserStatus'])->name('admin.user.status');


    Route::get('/profile/edit', [DashboardController::class, 'adminDashboard'])->name('profile.edit');
    // Route::delete('/projects/{id}', [ProjectController::class, 'destroyByAdmin']);
});

Route::middleware(['auth', RoleMiddleware::class . ':employee'])->group(function () {
    Route::get('/employee/dashboard', [DashboardController::class, 'employeeDashboard'])->name('employee.dashboard');
    Route::resource('/projects', ProjectController::class);
});
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::get('employee-login', [AuthenticatedSessionController::class, 'Employee'])
        ->name('employee-login');
    Route::post('employee-login', [AuthenticatedSessionController::class, 'EmployeeStore'])
        ->name('employee-login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});
Route::get('/change-language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        App::setLocale($locale);
        session(['locale' => $locale]); // Store the selected locale in the session
    }
    return redirect()->back();
});
Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
