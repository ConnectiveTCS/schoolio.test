<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Central\CentralAdminController;
use App\Http\Controllers\Central\TenantManagementController;
use App\Http\Controllers\Central\SupportController;
use App\Http\Controllers\Central\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Central\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        });

        // Central Admin Authentication Routes
        Route::prefix('central')->name('central.')->group(function () {
            // Guest routes (login, register)
            Route::middleware('guest:central_admin')->group(function () {
                Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
                Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
                Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
                Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');
            });

            // Authenticated central admin routes
            Route::middleware('auth:central_admin')->group(function () {
                Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

                // Dashboard
                Route::get('dashboard', [CentralAdminController::class, 'dashboard'])->name('dashboard');

                // Admin management
                Route::resource('admins', CentralAdminController::class);

                // Tenant management
                Route::resource('tenants', TenantManagementController::class);
                Route::post('tenants/{tenant}/suspend', [TenantManagementController::class, 'suspend'])->name('tenants.suspend');
                Route::post('tenants/{tenant}/activate', [TenantManagementController::class, 'activate'])->name('tenants.activate');
                Route::post('tenants/{tenant}/impersonate', [TenantManagementController::class, 'impersonate'])->name('tenants.impersonate');

                // Support system
                Route::prefix('support')->name('support.')->group(function () {
                    Route::get('/', [SupportController::class, 'index'])->name('index');
                    Route::get('dashboard', [SupportController::class, 'dashboard'])->name('dashboard');
                    Route::get('{ticket}', [SupportController::class, 'show'])->name('show');
                    Route::post('{ticket}/assign', [SupportController::class, 'assign'])->name('assign');
                    Route::patch('{ticket}/status', [SupportController::class, 'updateStatus'])->name('update-status');
                    Route::post('{ticket}/reply', [SupportController::class, 'reply'])->name('reply');
                    Route::get('{ticket}/download/{filename}', [SupportController::class, 'downloadAttachment'])->name('download')->where('filename', '.*');
                });

                // System settings (placeholder for future implementation)
                // Route::get('settings', function () {
                //     return view('central.settings.index');
                // })->name('settings')->middleware('can:system_settings,App\Models\CentralAdmin');
                Route::get('settings', function () {
                    return view('central.settings.index');
                })->name('settings');
                Route::get('permissions', [CentralAdminController::class, 'permissions'])->name('permissions.index');
                Route::post('permissions/create', [CentralAdminController::class, 'permissionsCreate'])->name('permissions.create');
            });
        });

        // Regular tenant user routes
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    });
}

require __DIR__ . '/auth.php';
