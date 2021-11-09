<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseAdminController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\FrontpagesController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PenerjemahanAdminController;
use App\Http\Controllers\PenerjemahanStudentController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileMahasiswaController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\SchedulesStudentController;
use App\Http\Controllers\StudentListController;
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
Route::get('/', [FrontpagesController::class, 'index'])->name("/");
Route::get('news', [FrontpagesController::class, 'NewsIndex'])->name("news.index");
Route::get('news-show/{id}', [FrontPagesController::class, 'ShowNews'])->name("news.show");
Route::get('register', [RegisterController::class, 'create'])->name('register.create');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');
Route::get('sign-in', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('sign-in', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');

// DASHBOARD STUDENT
Route::get('student', [MahasiswaController::class, 'index'])->name('student.index');
Route::resource('profileStudent', ProfileMahasiswaController::class);
Route::resource('quota-show', SchedulesStudentController::class);
Route::resource('registerCourses', CourseStudentController::class);
Route::get('schedule/{id}/schedules', [SchedulesStudentController::class, 'getSchedules']);
Route::get('courses/{id}/schedules', [CourseStudentController::class, 'getSchedules']);
Route::get('courses/{id}/bukti_pembayaran', [CourseStudentController::class, 'getCourse']);
Route::resource('penerjemahan-student', PenerjemahanStudentController::class);

// DASHBOARD ADMIN
Route::resource('admin', AdminController::class)->except([
    'create', 'store', 'edit' 
]);;
// Route::get('admin-edit/{id_jadwal}/{id_kursus}', [AdminController::class, 'edit'])->name('admin.edit');  
Route::get('admin-edit/{id_kursus}', [AdminController::class, 'edit'])->name('admin.edit');
Route::patch('admin/{id_mahasiswa}/{id_kursus}', [AdminController::class, 'update'])->name('admin.update');
Route::resource('profileAdmin', ProfileAdminController::class);
Route::resource('schedules', SchedulesController::class);
Route::resource('addCourse', CourseAdminController::class);
Route::patch('deactive-course/{id_kursus}', [CourseAdminController::class, 'deactiveCourse'])->name('addCourse.deactive');
Route::get('studentList', [StudentListController::class, 'index'])->name('studentList.index');
Route::get('studentList/{year}/{id_kursus}', [StudentListController::class, 'changeYear'])->name('studentList.changeYear');
Route::patch('send-komentar/{id_mahasiswa}/{id_kursus}', [AdminController::class, 'sendKomentar'])->name('admin.sendKomentar');
Route::get('PdfDemo/{id_kursus}/{id_mahasiswa_satu}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF'])->name('generate.pdf');
Route::get('PdfDemo/{id_abstract}/{id_mahasiswa_satu}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF2'])->name('generate2.pdf');
Route::get('PdfDemo/{id_transkrip_nilai}/{id_mahasiswa_satu}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF3'])->name('generate3.pdf');
Route::get('PdfDemo/{id_ijazah}/{id_mahasiswa_satu}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF4'])->name('generate4.pdf');
Route::resource('addNews', NewsController::class);
Route::resource('penerjemahan-admin', PenerjemahanAdminController::class);
Route::get('penerjemahan-admin-abstrak-edit/{id_penerjemahan}/{id_mahasiswa}', [PenerjemahanAdminController::class, 'editPageAbstrak'])->name('penerjemahan-admin.editPageAbstrak');
Route::get('penerjemahan-admin-jurnal-edit/{id_jurnal}/{id_mahasiswa}', [PenerjemahanAdminController::class, 'editPageJurnal'])->name('penerjemahan-admin.editPageJurnal');
Route::patch('penerjemahan-admin-abstrak/{id_penerjemahan}/{id_mahasiswa}', [PenerjemahanAdminController::class, 'updatePartialAbstrak'])->name('penerjemahan-admin.updatePartialAbstrak');
Route::patch('penerjemahan-admin-jurnal/{id_jurnal}/{id_mahasiswa}', [PenerjemahanAdminController::class, 'updatePartialJurnal'])->name('penerjemahan-admin.updatePartialJurnal');


// SUPER ADMIN
Route::resource('super-admin', SuperAdminController::class);