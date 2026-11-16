<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Web\AuthenticatedSessionController as WebAuthenticatedSessionController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ProjectController as WebProjectController;
use App\Http\Controllers\Web\TaskController as WebTaskController;
use App\Http\Controllers\Web\TaskStatusController as WebTaskStatusController;
use App\Http\Controllers\Web\UserController as WebUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('login', [WebAuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [WebAuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function (): void {
    Route::post('logout', [WebAuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::resource('users', WebUserController::class)
        ->except(['show'])
        ->middleware('role:Administrator');
    Route::resource('projects', WebProjectController::class);
    Route::resource('tasks', WebTaskController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::get('projects/{project}/tasks/create', [WebTaskController::class, 'create'])->name('projects.tasks.create');
    Route::post('projects/{project}/tasks', [WebTaskController::class, 'store'])->name('projects.tasks.store');
    Route::patch('tasks/{task}/status', WebTaskStatusController::class)->name('tasks.status.update');
});

Route::prefix('api')->name('api.')->group(function (): void {
    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest')
        ->name('login');

    Route::middleware('auth')->group(function (): void {
        Route::get('me', [AuthenticatedSessionController::class, 'current'])->name('me');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::apiResource('users', UserController::class)->middleware('role:Administrator');
        Route::apiResource('projects', ProjectController::class);

        Route::get('projects/{project}/tasks', [TaskController::class, 'index'])->name('projects.tasks.index');
        Route::post('projects/{project}/tasks', [TaskController::class, 'store'])->name('projects.tasks.store');
        Route::get('tasks', [TaskController::class, 'all'])->name('tasks.index');
        Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
        Route::match(['put', 'patch'], 'tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
        Route::patch('tasks/{task}/status', TaskStatusController::class)->name('tasks.status.update');
    });
});
