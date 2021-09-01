<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseAdminController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileMahasiswaController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\SchedulesStudentController;
use App\Http\Controllers\SuperAdminController;

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

// FRONTPAGES
Route::view('/', 'frontpages.home.index')->name("/");
// Route::view('register', 'frontpages.account.register.index')->name('register');
// Route::view('sign_in', 'frontpages.account.sign-in.index')->name('sign-in');
Route::get('register', [RegisterController::class, 'create'])->name('register.create');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');
Route::get('sign-in', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('sign-in', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');

// DASHBOARD STUDENT
// Route::view('student', 'student.main.dashboard')->name('student-index');
Route::get('student', [MahasiswaController::class, 'index'])->name('student.index');
Route::resource('profileStudent', ProfileMahasiswaController::class);
Route::resource('schedules-show', SchedulesStudentController::class);
Route::resource('registerCourses', CourseStudentController::class);
Route::get('schedule/{id}/schedules', [SchedulesStudentController::class, 'getSchedules']);
Route::get('courses/{id}/schedules', [CourseStudentController::class, 'getSchedules']);
Route::get('courses/{id}/bukti_pembayaran', [CourseStudentController::class, 'getCourse']);
// Route::get('courses/{id}/id', [CourseStudentController::class, 'getIdKursus'])->name('getIdKursus');

// DASHBOARD ADMIN
// Route::view('admin', 'admin.main.dashboard_admin.index')->name('admin.index');
Route::resource('admin', DashboardAdminController::class);
Route::resource('profileAdmin', ProfileAdminController::class);
Route::resource('schedules', SchedulesController::class);
Route::resource('addCourse', CourseAdminController::class);
Route::patch('send-komentar/{id}', [DashboardAdminController::class, 'sendKomentar'])->name('admin.sendKomentar');
Route::view('addNews', 'admin.main.news_admin.index');
// Route::view('coursesType', 'admin.main.courses_admin.courses_type.index');
// Route::view('addSchedules','admin.main.schedules_admin.create');



//COURSES TEST VIEW
// Route::view('addCourse/create', 'admin.main.courses_admin.courses.create');
// Route::view('coursesType/create', 'admin.main.courses_admin.courses_type.create');
// Route::view('admin/show', 'admin.main.dashboard_admin.show');

// SUPER ADMIN
// Route::get('super-admin', [SuperAdminController::class, 'index'])->name('super-admin.index');
Route::resource('super-admin', SuperAdminController::class);
// Route::resource('super-admin', SuperAdminController::class);