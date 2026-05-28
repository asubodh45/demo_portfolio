<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\ProcessStepController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SkillController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{slug}', [ProjectController::class, 'show']);

    Route::get('/categories', [CategoryController::class, 'index']);

    Route::get('/services', [ServiceController::class, 'index']);

    Route::get('/process-steps', [ProcessStepController::class, 'index']);

    Route::get('/skills', [SkillController::class, 'index']);

    Route::get('/experience', [ExperienceController::class, 'index']);

    Route::get('/settings', [SettingController::class, 'index']);

    Route::get('/notes', [NoteController::class, 'index']);
    Route::get('/notes/{slug}', [NoteController::class, 'show']);

    Route::post('/contact', [ContactController::class, 'store']);
});
