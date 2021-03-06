<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])
    ->name('welcome');

Route::get('/guide', function () {
    return view('guide');
})->name('guide');

Route::get('/legal', function () {
    return view('legal');
})->name('legal');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

require __DIR__ . '/auth.php';

Route::resource('mentor_schedules', App\Http\Controllers\MentorScheduleController::class)
    ->only(['index'])
    ->middleware('auth:users');

Route::resource('mentor_schedules', App\Http\Controllers\MentorScheduleController::class)
    ->only(['create', 'store', 'destroy'])
    ->middleware('auth:mentors');

Route::resource('reservations', App\Http\Controllers\ReservationController::class)
    ->only(['index', 'create', 'store', 'show', 'destroy'])
    ->middleware(['auth:users,mentors']);

Route::resource('users.mentors.messages', App\Http\Controllers\MessageController::class)
    ->only(['index', 'store'])
    ->middleware(['auth:users,mentors']);

Route::resource('mentors.messages', App\Http\Controllers\MentorMessageController::class)
    ->only(['index', 'store'])
    ->middleware(['auth:mentors']);

Route::resource('mentors.mentor_skills', App\Http\Controllers\MentorSkillController::class)
    ->only(['create', 'store', 'destroy'])
    ->middleware('auth:mentors');

Route::resource('mentors', App\Http\Controllers\MentorController::class)
    ->only('show')
    ->middleware('auth:users');

Route::resource('mentors', App\Http\Controllers\MentorController::class)
    ->only('index')
    ->middleware('auth:mentors');

Route::resource('mentors.bookmarks', App\Http\Controllers\BookmarkController::class)
    ->only(['store', 'destroy'])
    ->middleware('auth:users');

Route::resource('mentors.reviews', App\Http\Controllers\ReviewController::class)
    ->only(['store'])
    ->middleware('auth:users');

Route::post('/stripe/payment', [
    App\Http\Controllers\StripePaymentsController::class, 'payment'
])->name('payment');

Route::get('/stripe/complete', [
    App\Http\Controllers\StripePaymentsController::class, '???complete???'
])->name('complete');

Route::get('/stripe', [
    App\Http\Controllers\StripePaymentsController::class, 'index'
])->name('index');

Route::get('/mail', [
    App\Http\Controllers\MailSendController::class, 'send'
])->name('mail.send');
