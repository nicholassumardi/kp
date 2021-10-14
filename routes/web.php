<?php

use App\Http\Controllers\AbstrakAdminController;
use App\Http\Controllers\AbstrakStudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseAdminController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\FrontPages;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PdfController;
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
Route::get('/', [FrontPages::class, 'index'])->name("/");
Route::get('news', [FrontPages::class, 'NewsIndex'])->name("news.index");
Route::Get('news-show/{id}', [FrontPages::class, 'ShowNews'])->name("news.show");
Route::get('register', [RegisterController::class, 'create'])->name('register.create');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');
Route::get('sign-in', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('sign-in', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');

// DASHBOARD STUDENT
Route::get('student', [MahasiswaController::class, 'index'])->name('student.index');
Route::resource('profileStudent', ProfileMahasiswaController::class);
Route::resource('schedules-show', SchedulesStudentController::class);
Route::resource('registerCourses', CourseStudentController::class);
Route::get('schedule/{id}/schedules', [SchedulesStudentController::class, 'getSchedules']);
Route::get('courses/{id}/schedules', [CourseStudentController::class, 'getSchedules']);
Route::get('courses/{id}/bukti_pembayaran', [CourseStudentController::class, 'getCourse']);
Route::resource('abstract-student', AbstrakStudentController::class);

// DASHBOARD ADMIN
Route::resource('admin', AdminController::class)->except([
    'create', 'store', 'edit' 
]);;
Route::get('admin-edit/{id_jadwal}/{id_kursus}', [AdminController::class, 'edit'])->name('admin.edit');
Route::patch('admin/{id_mahasiswa}/{id_kursus}', [AdminController::class, 'update'])->name('admin.update');
Route::resource('profileAdmin', ProfileAdminController::class);
Route::resource('schedules', SchedulesController::class);
Route::resource('addCourse', CourseAdminController::class);
Route::patch('send-komentar/{id_mahasiswa}/{id_kursus}', [AdminController::class, 'sendKomentar'])->name('admin.sendKomentar');
Route::get('PdfDemo/{id_kursus}/{id_mahasiswa_satu}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF'])->name('generate.pdf');
Route::resource('addNews', NewsController::class);
Route::resource('abstract-admin', AbstrakAdminController::class);
Route::get('abstract-admin/{id_abstrak}/{id_mahasiswa}', [AbstrakAdminController::class, 'editPage'])->name('abstract-admin.editPage');
Route::patch('abstract-admin/{id_abstrak}/{id_mahasiswa}', [AbstrakAdminController::class, 'updatePartial'])->name('abstract-admin.updatePartial');

// SUPER ADMIN
Route::resource('super-admin', SuperAdminController::class);