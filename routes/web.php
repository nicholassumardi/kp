<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseAdminController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\CourseUmumController;
use App\Http\Controllers\FrontpagesController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PdfUmumController;
use App\Http\Controllers\PenerjemahanAdminController;
use App\Http\Controllers\PenerjemahanStudentController;
use App\Http\Controllers\PenerjemahanUmumController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileMahasiswaController;
use App\Http\Controllers\ProfileUmumController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\SchedulesStudentController;
use App\Http\Controllers\SchedulesUmumController;
use App\Http\Controllers\StudentListController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UmumController;

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
Route::get('student-edit/{id}', [MahasiswaController::class, 'edit'])->name('student.edit');
Route::patch('student-update/{id_mahasiswa}/{id_kursus}', [MahasiswaController::class, 'update'])->name('student.update');


// // DASHBOARD UMUM/ PUBLIC
Route::get('public', [UmumController::class, 'index'])->name('umum.index');
Route::resource('profilePublic', ProfileUmumController::class);
Route::resource('quota-show-public', SchedulesUmumController::class);
Route::resource('registerCoursesPublic', CourseUmumController::class);
Route::get('courses-public/{id}/bukti_pembayaran', [CourseUmumController::class, 'getCourse']);
Route::resource('penerjemahan-public', PenerjemahanUmumController::class);
Route::get('public-edit/{id}', [UmumController::class, 'edit'])->name('umum.edit');
Route::patch('public-update/{id_umum}/{id_kursus}', [UmumController::class, 'update'])->name('umum.update');


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
// PDF MAHASISWA
Route::get('PdfDemo/{id_kursus}/{id_mahasiswa_satu}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF'])->name('generate.pdf');
Route::get('PdfDemo1/{id_abstract}/{id_mahasiswa_satu}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF2'])->name('generate2.pdf');
Route::get('PdfDemo2/{id_transkrip_nilai}/{id_mahasiswa_satu}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF3'])->name('generate3.pdf');
Route::get('PdfDemo3/{id_ijazah}/{id_mahasiswa_satu}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF4'])->name('generate4.pdf');
Route::get('PdfDemo4/{id_jurnal}/{id_mahasiswa_satu}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF5'])->name('generate5.pdf');
Route::resource('addNews', NewsController::class);
Route::resource('penerjemahan-admin', PenerjemahanAdminController::class);
Route::get('penerjemahan-admin-abstrak-edit/{id_penerjemahan}/{id_mahasiswa}', [PenerjemahanAdminController::class, 'editPageAbstrak'])->name('penerjemahan-admin.editPageAbstrak');
Route::get('penerjemahan-admin-jurnal-edit/{id_jurnal}/{id_mahasiswa}', [PenerjemahanAdminController::class, 'editPageJurnal'])->name('penerjemahan-admin.editPageJurnal');
Route::patch('penerjemahan-admin-abstrak/{id_abstrak}/{id_mahasiswa}', [PenerjemahanAdminController::class, 'updatePartialAbstrak'])->name('penerjemahan-admin.updatePartialAbstrak');
Route::patch('penerjemahan-admin-jurnal/{id_jurnal}/{id_mahasiswa}', [PenerjemahanAdminController::class, 'updatePartialJurnal'])->name('penerjemahan-admin.updatePartialJurnal');




// PDF UMUM
Route::get('PdfDemoUmum/{id_kursus}/{id_umum_satu}/{id_umum_dua?}', [PdfUmumController::class, 'makePDF'])->name('generateUmum.pdf');
Route::get('PdfDemoUmum1/{id_abstract_umum}/{id_umum_satu}/{id_umum_dua?}', [PdfUmumController::class, 'makePDF2'])->name('generateUmum2.pdf');
Route::get('PdfDemoumum2/{id_transkrip_nilai_umum}/{id_umum_satu}/{id_umum_dua?}', [PdfUmumController::class, 'makePDF3'])->name('generateUmum3.pdf');
Route::get('PdfDemoUmum3/{id_ijazah_umum}/{id_umum_satu}/{id_umum_dua?}', [PdfUmumController::class, 'makePDF4'])->name('generateUmum4.pdf');
Route::get('PdfDemoUmum4/{id_jurnal_umum}/{id_umum_satu}/{id_umum_dua?}', [PdfUmumController::class, 'makePDF5'])->name('generateUmum5.pdf');
Route::get('penerjemahan-admin-abstrak-umum-edit/{id_penerjemahan_umum}/{id_umum}', [PenerjemahanAdminController::class, 'editPageAbstrakUmum'])->name('penerjemahan-admin.editPageAbstrakUmum');
Route::get('penerjemahan-admin-jurnal-umum-edit/{id_jurnal_umum}/{id_umum}', [PenerjemahanAdminController::class, 'editPageJurnalUmum'])->name('penerjemahan-admin.editPageJurnalUmum');
Route::patch('penerjemahan-admin-abstrak/{id_abstrak_umum}/{id_umum}', [PenerjemahanAdminController::class, 'updatePartialAbstrak'])->name('penerjemahan-admin.updatePartialAbstrak');
Route::patch('penerjemahan-admin-jurnal/{id_jurnal_umum}/{id_umum}', [PenerjemahanAdminController::class, 'updatePartialJurnal'])->name('penerjemahan-admin.updatePartialJurnal');

// SUPER ADMIN
Route::resource('super-admin', SuperAdminController::class);
