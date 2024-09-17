<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// ###############  Auth Routes ##########################
Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
});

// ############# User Routes ################################
Route::apiResource('users', UserController::class)->middleware(['auth:api', 'Admin']);
Route::get('user/allProjects', [UserController::class, 'getUserProjects'])->middleware(['auth:api']);
// get my tasks for project by id
Route::get('users/projects/{id}/tasks', [UserController::class, 'getProjectTasks'])->middleware(['auth:api']);


// ############  Project Routes ##############################
Route::middleware('auth:api')->group(function () {
    Route::apiResource('projects', ProjectController::class);
    Route::post('projects/{id}/attachUser', [ProjectController::class, 'attachUser']);
    Route::get('projects/{id}/users', [ProjectController::class, 'getProjectUsers']);
    Route::get('projects/{id}/allTasks', [ProjectController::class, 'getProjectTasks']);
    Route::get('projectUser/{id}/tasks', [ProjectController::class, 'getProjectUserTasks']);
    Route::get('projects/{id}/latestTask', [ProjectController::class, 'getLatestTask']);
    Route::get('projects/{id}/oldestTask', [ProjectController::class, 'getOldestTask']);
    Route::get('projects/{id}/highPriorityTask', [ProjectController::class, 'getHighPriorityTask']);
});


// ########### Task Routes ##################################
Route::apiResource('tasks', TaskController::class);
Route::post('tasks/{id}/updateStatus', [TaskController::class, 'updateStatusTask']);
Route::post('tasks/{id}/addNote', [TaskController::class, 'addNoteToTask']);
