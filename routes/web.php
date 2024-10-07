<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Task Routes
Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::post('/tasks/search', [TaskController::class, 'search'])->name('tasks.search');
Route::delete('/tasks/delete-all', [TaskController::class, 'deleteAll'])->name('tasks.deleteAll');
Route::get('/tasks/filter/{status}', [TaskController::class, 'filterByStatus'])->name('tasks.filter');

