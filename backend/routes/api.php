<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public API routes
|--------------------------------------------------------------------------
|
| These routes are consumed by the Nuxt frontend and are safe to expose
| without authentication. Admin/authenticated routes (CRUD, dashboard)
| will be added under a protected group using Sanctum later.
|
*/

Route::prefix('v1')->group(function () {
    Route::get('about', [AboutController::class, 'index']);

    Route::get('projects', [ProjectController::class, 'index']);
    Route::get('projects/featured', [ProjectController::class, 'featured']);
    Route::get('projects/{slug}', [ProjectController::class, 'show']);

    Route::get('skills', [SkillController::class, 'index']);
    Route::get('experience', [ExperienceController::class, 'index']);

    Route::post('contact', [ContactController::class, 'store'])->middleware('throttle:10,1');
});

/*
|--------------------------------------------------------------------------
| Authenticated (admin-ready) routes
|--------------------------------------------------------------------------
|
| Currently only the authenticated user endpoint is exposed. Future admin
| CRUD endpoints will live here behind the Sanctum guard.
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
