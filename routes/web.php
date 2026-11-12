<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
