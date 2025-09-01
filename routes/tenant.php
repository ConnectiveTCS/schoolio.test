<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenants\TenantController;
use App\Http\Controllers\Tenants\TenantUserController;
use App\Http\Controllers\Tenants\ImpersonationController;
use App\Http\Controllers\Tenants\SupportController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Tenants\TenantClassesController;
use App\Http\Controllers\Tenants\TenantStudentController;
use App\Http\Controllers\Tenants\TenantTeacherController;
use App\Http\Controllers\Tenants\AnnouncementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    // Public tenant routes
    Route::get('/', [TenantController::class, 'index'])->name('tenant.index');

    // Impersonation routes (must be before guest middleware)
    Route::get('/impersonate', [ImpersonationController::class, 'handleImpersonation'])->name('impersonate');

    // Guest routes (authentication)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [TenantController::class, 'index'])->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('/register', [RegisteredUserController::class, 'store']);
    });

    // Authenticated routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [TenantController::class, 'dashboard'])->name('dashboard');
        Route::get('/settings', [TenantController::class, 'settings'])->name('settings');
        Route::put('/settings', [TenantController::class, 'updateSettings'])->name('settings.update');
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        Route::get('/users', [TenantController::class, 'listUsers'])->name('tenant.users');
        Route::get('/users/create', [TenantUserController::class, 'create'])->name('tenant.users.create');
        Route::post('/users', [TenantUserController::class, 'store'])->name('tenant.users.store');
        Route::get('/users/{user}', [TenantUserController::class, 'show'])->name('tenant.users.show');
        Route::get('/users/{user}/edit', [TenantUserController::class, 'edit'])->name('tenant.users.edit');
        Route::put('/users/{user}', [TenantUserController::class, 'update'])->name('tenant.users.update');
        Route::delete('/users/{user}', [TenantUserController::class, 'destroy'])->name('tenant.users.destroy');
        Route::get('/teachers', [TenantTeacherController::class, 'index'])->name('tenant.teachers');
        Route::get('/teachers/create', [TenantTeacherController::class, 'create'])->name('tenant.teachers.create');
        Route::post('/teachers', [TenantTeacherController::class, 'store'])->name('tenant.teachers.store');
        Route::get('/teachers/{teacher}', [TenantTeacherController::class, 'show'])->name('tenant.teachers.show');
        Route::get('/teachers/{teacher}/edit', [TenantTeacherController::class, 'edit'])->name('tenant.teachers.edit');
        Route::put('/teachers/{teacher}', [TenantTeacherController::class, 'update'])->name('tenant.teachers.update');
        Route::delete('/teachers/{teacher}', [TenantTeacherController::class, 'destroy'])->name('tenant.teachers.destroy');
        Route::get('/students', [TenantStudentController::class, 'index'])->name('tenant.students');
        Route::get('/students/create', [TenantStudentController::class, 'create'])->name('tenant.students.create');
        Route::post('/students', [TenantStudentController::class, 'store'])->name('tenant.students.store');
        Route::get('/students/{student}', [TenantStudentController::class, 'show'])->name('tenant.students.show');
        Route::get('/students/{student}/edit', [TenantStudentController::class, 'edit'])->name('tenant.students.edit');
        Route::put('/students/{student}', [TenantStudentController::class, 'update'])->name('tenant.students.update');
        Route::delete('/students/{student}', [TenantStudentController::class, 'destroy'])->name('tenant.students.destroy');
        Route::post('/students/{student}/enroll', [TenantStudentController::class, 'enrollInClass'])->name('tenant.students.enrollInClass');
        Route::delete('/students/{student}/classes/{class}', [TenantStudentController::class, 'unenrollFromClass'])->name('tenant.students.unenrollFromClass');
        Route::get('/classes', [TenantClassesController::class, 'index'])->name('tenant.classes');
        Route::get('/classes/create', [TenantClassesController::class, 'create'])->name('tenant.classes.create');
        Route::post('/classes', [TenantClassesController::class, 'store'])->name('tenant.classes.store');
        Route::get('/classes/{class}', [TenantClassesController::class, 'show'])->name('tenant.classes.show');
        Route::get('/classes/{class}/edit', [TenantClassesController::class, 'edit'])->name('tenant.classes.edit');
        Route::put('/classes/{class}', [TenantClassesController::class, 'update'])->name('tenant.classes.update');
        Route::delete('/classes/{class}', [TenantClassesController::class, 'destroy'])->name('tenant.classes.destroy');
        Route::post('/classes/{class}/students', [TenantClassesController::class, 'addStudent'])->name('tenant.classes.addStudent');
        Route::delete('/classes/{class}/students/{student}', [TenantClassesController::class, 'removeStudent'])->name('tenant.classes.removeStudent');

        // Announcement routes
        Route::get('/announcements/my', [AnnouncementController::class, 'userAnnouncements'])->name('tenant.announcements.my');
        Route::resource('announcements', AnnouncementController::class, [
            'as' => 'tenant'
        ]);
        Route::patch('/announcements/{announcement}/toggle-status', [AnnouncementController::class, 'toggleStatus'])->name('tenant.announcements.toggle-status');
        Route::get('/announcements/{announcement}/download/{filename}', [AnnouncementController::class, 'downloadAttachment'])->name('tenant.announcements.download');

        // Support routes
        Route::prefix('support')->name('tenant.support.')->group(function () {
            Route::get('/', [SupportController::class, 'index'])->name('index');
            Route::get('/create', [SupportController::class, 'create'])->name('create');
            Route::post('/', [SupportController::class, 'store'])->name('store');
            Route::get('/{ticket}', [SupportController::class, 'show'])->name('show');
            Route::post('/{ticket}/reply', [SupportController::class, 'reply'])->name('reply');
            Route::get('/{ticket}/download/{filename}', [SupportController::class, 'downloadAttachment'])->name('download')->where('filename', '.*');
        });

        // Activity management routes
        Route::get('/api/activities', [TenantController::class, 'getActivities'])->name('tenant.activities.index');
        Route::delete('/api/activities/clear-all', [TenantController::class, 'clearAllActivities'])->name('tenant.activities.clear-all');
        Route::delete('/api/activities/{index}', [TenantController::class, 'clearActivity'])->name('tenant.activities.clear');

        // Impersonation end route
        Route::post('/end-impersonation', [ImpersonationController::class, 'endImpersonation'])->name('end-impersonation');

        // Serve tenant files
        Route::get('/storage/{path}', [TenantController::class, 'serveFile'])
            ->where('path', '.*')
            ->name('tenant.file');
    });
});
