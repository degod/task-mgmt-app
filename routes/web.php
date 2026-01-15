<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

Route::get('/', HomeController::class)->name('home');

Route::post('/project', [ProjectController::class, 'store'])->name('projects.store');

Route::post('/task', [TaskController::class, 'store'])->name('tasks.store');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.delete');
Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');
