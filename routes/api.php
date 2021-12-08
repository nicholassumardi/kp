<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\CourseUmumController;
use App\Http\Controllers\PenerjemahanAdminController;

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
    // Route::get('{id}/schedules', [CourseStudentController::class, 'getSchedules']);
    Route::get('{id}', [CourseStudentController::class, 'getCourse']);
});

Route::prefix('courses-umum')->group(function () {
    // Route::get('{id}/schedules', [CourseStudentController::class, 'getSchedules']);
    Route::get('{id}', [CourseUmumController::class, 'getCourse']);
});


// Abstrak
Route::post('abstrak-jurnal-change-status', [PenerjemahanAdminController::class, 'changeStatusToPending']);
Route::post('transkrip-ijazah-change-status', [PenerjemahanAdminController::class, 'changeStatusToChecked']);
