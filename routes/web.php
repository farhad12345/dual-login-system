<?php

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MarriageFormController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\wahajwatan\WahajController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\oppointments\OppintmentController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
require base_path('/routes/wahaj_routes.php');
require base_path('/routes/almawayeed_routes.php');

Route::get('/clear', function () {
    // Clear application cache
    Artisan::call('cache:clear');

    // Clear route cache
    Artisan::call('route:clear');

    // Clear config cache
    Artisan::call('config:clear');

    // Clear view cache
    Artisan::call('view:clear');

    // Clear compiled classes
    Artisan::call('optimize:clear');
    return redirect('/');

    // return 'Cache cleared successfully!';
});
Route::get('projects/pdf', [ProjectController::class, 'downloadPdf'])->name('projects.downloadPdf');

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

    Route::post('admin/projects/index', action: [DashboardController::class, 'index'])->name('admin.projects.index');

   Route::get('/admin/maweed/prevoius/projects', [DashboardController::class, 'PrevoiusMaweedProjects'])->name('admin.prevoius.maweed.projects');

   //admin add reason
   Route::post('/admin/projects/save-reason', [DashboardController::class, 'saveReason'])->name('admin.projects.saveReason');

   //wahaj projects
   Route::get('/admin/wahajprojects/saveReason', [WahajController::class, 'WahajWatanSaveReason'])->name('admin.wahajprojects.saveReason');
   Route::get('/admin/wahajprojects/edit/{id}', [WahajController::class, 'WahajProjectEdit'])->name('admin.wahajprojects.edit');
   Route::get('/admin/wahajprojects/destroy/{id}', [WahajController::class, 'WahajProjectDestroy'])->name('admin.wahajprojects.destroy');
   Route::get('/admin/view-wahajprojects/{id}', [WahajController::class, 'ViewWahajProjects'])->name('admin.view-Wahajprojects');
   Route::get('/admin/wahajprojects/create', [WahajController::class, 'WahajProjectCreate'])->name('admin.wahajprojects.create');
   Route::post('/admin/wahajprojects/store', [WahajController::class, 'WahajProjectStore'])->name('admin.wahajprojects.store');
   Route::PUT('/admin/wahajprojects/update/{id}', [WahajController::class, 'WahajProjectUpdate'])->name('admin.wahajprojects.update');


//Almaweed routes
   Route::get('/admin/almawayeed/saveReason', [OppintmentController::class, 'AlmawayeedSaveReason'])->name('admin.almawayeed.saveReason');
   Route::get('/admin/almawayeed/edit/{id}', [OppintmentController::class, 'AlmawayeedProjectEdit'])->name('admin.almawayeed.edit');
   Route::get('/admin/almawayeed/destroy/{id}', [OppintmentController::class, 'AlmawayeedProjectDestroy'])->name('admin.almawayeed.destroy');
   Route::get('/admin/view-almawayeed/{id}', [OppintmentController::class, 'ViewAlmawayeedProjects'])->name('admin.view-almawayeed');
   Route::get('/admin/almawayeed/create', [OppintmentController::class, 'AlmawayeedProjectCreate'])->name('admin.almawayeed.create');
   Route::post('/admin/almawayeed/store', [OppintmentController::class, 'AlmawayeedProjectStore'])->name('admin.almawayeed.store');
   Route::PUT('/admin/almawayeed/update/{id}', [OppintmentController::class, 'AlmawayeedProjectUpdate'])->name('admin.almawayeed.update');


    Route::get('/profile/edit', [DashboardController::class, 'adminDashboard'])->name('profile.edit');
    // Route::delete('/projects/{id}', [ProjectController::class, 'destroyByAdmin']);
});
Route::middleware(['auth', RoleMiddleware::class . ':employee'])->group(function () {
    Route::get('/employee/dashboard', [DashboardController::class, 'employeeDashboard'])->name('employee.dashboard');
    Route::resource('/projects', ProjectController::class);
});


Route::middleware(['auth', RoleMiddleware::class . ':employee'])->group(function () {
    Route::get('/employee/dashboard', [DashboardController::class, 'employeeDashboard'])->name('employee.dashboard');
    Route::resource('/projects', ProjectController::class);
});
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

    Route::post('employe/logout', [ProjectController::class, 'Logout'])
    ->name('Employelogout');
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


//apis
Route::get('/get/amertm_data/list', [DashboardController::class, 'adminDashboardListData'])->name('profile.edit');

Route::get('projects/report/download', [DashboardController::class, 'downloadProjectsReport'])->name('projects.report.download');
