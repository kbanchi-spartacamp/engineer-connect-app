<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api', 'auth:sanctum']], function () {
    Route::apiResource('users.mentors.messages', App\Http\Controllers\Api\MessageController::class);
    Route::apiResource('mentor_schedules', App\Http\Controllers\Api\MentorScheduleController::class);
    Route::apiResource('reservations', App\Http\Controllers\Api\ReservationController::class);
    Route::apiResource('mentors.mentor_skills', App\Http\Controllers\Api\MentorSkillController::class);
    Route::apiResource('mentors', App\Http\Controllers\Api\MentorController::class);
    Route::apiResource('skill_categories', App\Http\Controllers\Api\SkillCategoryController::class);
    Route::apiResource('mentors.bookmarks', App\Http\Controllers\Api\BookmarkController::class);
    Route::apiResource('mentors.reviews', App\Http\Controllers\Api\ReviewController::class);
});

Route::post('/user/register', [App\Http\Controllers\Api\UserRegisterController::class, 'register']);
Route::post('/user/login', [App\Http\Controllers\Api\UserLoginController::class, 'login']);
Route::post('/mentor/register', [App\Http\Controllers\Api\MentorRegisterController::class, 'register']);
Route::post('/mentor/login', [App\Http\Controllers\Api\MentorLoginController::class, 'login']);
