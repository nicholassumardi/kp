<?php

use App\Http\Controllers\AbstrakAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseStudentController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Courses
Route::prefix('courses')->group(function () {
    Route::get('{id}/schedules', [CourseStudentController::class, 'getSchedules']);
    Route::get('{id}', [CourseStudentController::class, 'getCourse']);
});

// Abstrak
Route::post('abstrak/{id}', [AbstrakAdminController::class, 'changeStatusToPending']);
