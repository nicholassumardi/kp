<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseAdminController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\CourseUmumController;
use App\Http\Controllers\FrontpagesController;
use App\Http\Controllers\ListAkunMahasiswaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaUmumListController;
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
use App\Http\Controllers\UmumListController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UmumController;
use Illuminate\Support\Facades\Artisan;

Route::get('clear-all', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');

    return redirect('/');
});

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
Route::get('penerjemahan-student-downloadAbstrakAdminPDF/{id_mahasiswa}/{id_abstrak}', [PenerjemahanStudentController::class, 'downloadAbstrakAdminPDF'])->name('penerjemahan-student.downloadAbstrakAdminPDF');
Route::get('penerjemahan-student-downloadAbstrakAdminWORD/{id_mahasiswa}/{id_abstrak}', [PenerjemahanStudentController::class, 'downloadAbstrakAdminWORD'])->name('penerjemahan-student.downloadAbstrakAdminWORD');
Route::get('penerjemahan-student-downloadJurnalAdminPDF/{id_mahasiswa}/{id_jurnal}', [PenerjemahanStudentController::class, 'downloadJurnalAdminPDF'])->name('penerjemahan-student.downloadJurnalAdminPDF');
Route::get('penerjemahan-student-downloadJurnalAdminWORD/{id_mahasiswa}/{id_jurnal}', [PenerjemahanStudentController::class, 'downloadJurnalAdminWORD'])->name('penerjemahan-student.downloadJurnalAdminWORD');



// Edit Penerjemahan Student
Route::get('penerjemahan-student-editAbstrak/{id_abstrak}', [PenerjemahanStudentController::class, 'editAbstrak'])->name('penerjemahan-student.editAbstrak');
Route::get('penerjemahan-student-editJurnal/{id_jurnal}', [PenerjemahanStudentController::class, 'editJurnal'])->name('penerjemahan-student.editJurnal');
Route::get('penerjemahan-student-editIjazah/{id_ijazah}', [PenerjemahanStudentController::class, 'editIjazah'])->name('penerjemahan-student.editIjazah');
Route::get('penerjemahan-student-editTranskripNilai/{id_transkrip_nilai}', [PenerjemahanStudentController::class, 'editTranskripNilai'])->name('penerjemahan-student.editTranskripNilai');

Route::patch('penerjemahan-student-updateAbstrak/{id_abstrak}', [PenerjemahanStudentController::class, 'updateAbstrak'])->name('penerjemahan-student.updateAbstrak');
Route::patch('penerjemahan-student-updateJurnal/{id_jurnal}', [PenerjemahanStudentController::class, 'updateJurnal'])->name('penerjemahan-student.updateJurnal');
Route::patch('penerjemahan-student-updateIjazah/{id_ijazah}', [PenerjemahanStudentController::class, 'updateIjazah'])->name('penerjemahan-student.updateIjazah');
Route::patch('penerjemahan-student-updateTranskripNilai/{id_transkrip_nilai}', [PenerjemahanStudentController::class, 'updateTranskripNilai'])->name('penerjemahan-student.updateTranskripNilai');










// // DASHBOARD UMUM/ PUBLIC
Route::get('public', [UmumController::class, 'index'])->name('umum.index');
Route::resource('profilePublic', ProfileUmumController::class);
Route::resource('quota-show-public', SchedulesUmumController::class);
Route::resource('registerCoursesPublic', CourseUmumController::class);
Route::get('courses-public/{id}/bukti_pembayaran', [CourseUmumController::class, 'getCourse']);
Route::resource('penerjemahan-public', PenerjemahanUmumController::class);
Route::get('public-edit/{id}', [UmumController::class, 'edit'])->name('umum.edit');
Route::patch('public-update/{id_umum}/{id_kursus}', [UmumController::class, 'update'])->name('umum.update');
Route::get('penerjemahan-public-downloadAbstrakAdminPDF/{id_umum}/{id_abstrak_umum}', [PenerjemahanUmumController::class, 'downloadAbstrakAdminPDF'])->name('penerjemahan-public.downloadAbstrakAdminPDF');
Route::get('penerjemahan-public-downloadAbstrakAdminWORD/{id_umum}/{id_abstrak_umum}', [PenerjemahanUmumController::class, 'downloadAbstrakAdminWORD'])->name('penerjemahan-public.downloadAbstrakAdminWORD');
Route::get('penerjemahan-public-downloadJurnalAdminPDF/{id_umum}/{id_jurnal_umum}', [PenerjemahanUmumController::class, 'downloadJurnalAdminPDF'])->name('penerjemahan-public.downloadJurnalAdminPDF');
Route::get('penerjemahan-public-downloadJurnalAdminWORD/{id_umum}/{id_jurnal_umum}', [PenerjemahanUmumController::class, 'downloadJurnalAdminWORD'])->name('penerjemahan-public.downloadJurnalAdminWORD');






// Edit Penerjemahan Public
Route::get('penerjemahan-public-editAbstrak/{id_abstrak_umum}', [PenerjemahanUmumController::class, 'editAbstrakUmum'])->name('penerjemahan-public.editAbstrak');
Route::get('penerjemahan-public-editJurnal/{id_jurnal_umum}', [PenerjemahanUmumController::class, 'editJurnalUmum'])->name('penerjemahan-public.editJurnal');
Route::get('penerjemahan-public-editIjazah/{id_ijazah_umum}', [PenerjemahanUmumController::class, 'editIjazahUmum'])->name('penerjemahan-public.editIjazah');
Route::get('penerjemahan-public-editTranskripNilai/{id_transkrip_nilai_umum}', [PenerjemahanUmumController::class, 'editTranskripNilaiUmum'])->name('penerjemahan-public.editTranskripNilai');

Route::patch('penerjemahan-public-updateAbstrak/{id_abstrak_umum}', [PenerjemahanUmumController::class, 'updateAbstrakUmum'])->name('penerjemahan-public.updateAbstrak');
Route::patch('penerjemahan-public-updateJurnal/{id_jurnal_umum}', [PenerjemahanUmumController::class, 'updateJurnalUmum'])->name('penerjemahan-public.updateJurnal');
Route::patch('penerjemahan-public-updateIjazah/{id_ijazah_umum}', [PenerjemahanUmumController::class, 'updateIjazahUmum'])->name('penerjemahan-public.updateIjazah');
Route::patch('penerjemahan-public-updateTranskripNilai/{id_transkrip_nilai_umum}', [PenerjemahanUmumController::class, 'updateTranskripNilaiUmum'])->name('penerjemahan-public.updateTranskripNilai');






// DASHBOARD ADMIN
Route::resource('admin', AdminController::class)->except([
    'create', 'store', 'edit'
]);;
// Route::get('admin-edit/{id_jadwal}/{id_kursus}', [AdminController::class, 'edit'])->name('admin.edit');  
Route::get('admin-edit/{id_kursus}', [AdminController::class, 'edit'])->name('admin.edit');
Route::patch('admin/{id_mahasiswa}/{id_kursus}', [AdminController::class, 'update'])->name('admin.update');
Route::patch('admin2/{id_umum}/{id_kursus}', [AdminController::class, 'update2'])->name('admin.update2');
Route::resource('profileAdmin', ProfileAdminController::class);
Route::resource('schedules', SchedulesController::class);
Route::resource('addCourse', CourseAdminController::class);
Route::patch('deactive-course/{id_kursus}', [CourseAdminController::class, 'deactiveCourse'])->name('addCourse.deactive');
Route::get('studentList', [StudentListController::class, 'index'])->name('studentList.index');
Route::get('studentList/{year}/{id_kursus}', [StudentListController::class, 'changeYear'])->name('studentList.changeYear');
Route::get('umumList', [UmumListController::class, 'index'])->name('umumList.index');
Route::get('umumList/{year}/{id_kursus}', [UmumListController::class, 'changeYear'])->name('umumList.changeYear');
Route::get('mahasiswaUmumList', [MahasiswaUmumListController::class, 'index'])->name('mahasiswaUmumList.index');
Route::get('mahasiswaUmumList/{year}/{id_kursus}', [MahasiswaUmumListController::class, 'changeYear'])->name('mahasiswaUmumList.changeYear');
Route::patch('send-komentar/{id_mahasiswa}/{id_kursus}', [AdminController::class, 'sendKomentar'])->name('admin.sendKomentar');
Route::patch('send-komentar2/{id_umum}/{id_kursus}', [AdminController::class, 'sendKomentar2'])->name('admin.sendKomentar2');
Route::resource('addNews', NewsController::class);
Route::resource('penerjemahan-admin', PenerjemahanAdminController::class);


// Download Penerjemahan Mahasiswa
Route::get('penerjemahan-admin-downloadAbstrakMahasiswa/{id_mahasiswa}/{id_abstrak}', [PenerjemahanAdminController::class, 'downloadAbstrakMahasiswa'])->name('penerjemahan.downloadAbstrakMahasiswa');
Route::get('penerjemahan-admin-downloadTranskripMahasiswa/{id_mahasiswa}/{id_transkrip_nilai}', [PenerjemahanAdminController::class, 'downloadTranskripMahasiswa'])->name('penerjemahan.downloadTranskripMahasiswa');
Route::get('penerjemahan-admin-downloadIjazahMahasiswa/{id_mahasiswa}/{id_ijazah}', [PenerjemahanAdminController::class, 'downloadIjazahMahasiswa'])->name('penerjemahan.downloadIjazahMahasiswa');
Route::get('penerjemahan-admin-downloadJurnalMahasiswa/{id_mahasiswa}/{id_jurnal}', [PenerjemahanAdminController::class, 'downloadJurnalMahasiswa'])->name('penerjemahan.downloadJurnalMahasiswa');

// Download Penerjemahan Umum
Route::get('penerjemahan-admin-downloadAbstrakUmum/{id_umum}/{id_abstrak_umum}', [PenerjemahanAdminController::class, 'downloadAbstrakUmum'])->name('penerjemahan.downloadAbstrakUmum');
Route::get('penerjemahan-admin-downloadTranskripUmum/{id_umum}/{id_transkrip_nilai_umum}', [PenerjemahanAdminController::class, 'downloadTranskripUmum'])->name('penerjemahan.downloadTranskripUmum');
Route::get('penerjemahan-admin-downloadIjazahUmum/{id_umum}/{id_ijazah_umum}', [PenerjemahanAdminController::class, 'downloadIjazahUmum'])->name('penerjemahan.downloadIjazahUmum');
Route::get('penerjemahan-admin-downloadJurnalUmum/{id_umum}/{id_jurnal_umum}', [PenerjemahanAdminController::class, 'downloadJurnalUmum'])->name('penerjemahan.downloadJurnalUmum');

// PDF MAHASISWA
Route::get('PdfDemo/{id_kursus}/{id_mahasiswa_satu}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF'])->name('generate.pdf');
Route::get('PdfDemo1/{id_abstract_satu}/{id_mahasiswa_satu}/{id_abstract_dua?}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF2'])->name('generate2.pdf');
Route::get('PdfDemo2/{id_transkrip_nilai_satu}/{id_mahasiswa_satu}/{id_transkrip_nilai_dua?}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF3'])->name('generate3.pdf');
Route::get('PdfDemo3/{id_ijazah_satu}/{id_mahasiswa_satu}/{id_ijazah_dua?}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF4'])->name('generate4.pdf');
Route::get('PdfDemo4/{id_jurnal_satu}/{id_mahasiswa_satu}/{id_jurnal_dua?}/{id_mahasiswa_dua?}', [PdfController::class, 'makePDF5'])->name('generate5.pdf');
Route::get('penerjemahan-admin-abstrak-edit/{id_penerjemahan}/{id_mahasiswa}', [PenerjemahanAdminController::class, 'editPageAbstrak'])->name('penerjemahan-admin.editPageAbstrak');
Route::get('penerjemahan-admin-jurnal-edit/{id_jurnal}/{id_mahasiswa}', [PenerjemahanAdminController::class, 'editPageJurnal'])->name('penerjemahan-admin.editPageJurnal');
Route::patch('penerjemahan-admin-abstrak/{id_abstrak}/{id_mahasiswa}', [PenerjemahanAdminController::class, 'updatePartialAbstrak'])->name('penerjemahan-admin.updatePartialAbstrak');
Route::patch('penerjemahan-admin-jurnal/{id_jurnal}/{id_mahasiswa}', [PenerjemahanAdminController::class, 'updatePartialJurnal'])->name('penerjemahan-admin.updatePartialJurnal');

// SEND KOMENTAR MAHASISWA PENERJEMAHAN
Route::patch('penerjemahan-send-komentar/{id_abstrak}', [PenerjemahanAdminController::class, 'sendKomentarAbstrak'])->name('penerjemahan.sendKomentarAbstrak');
Route::patch('penerjemahan-send-komentar2/{id_transkrip_nilai}', [PenerjemahanAdminController::class, 'sendKomentarTranskripNilai'])->name('penerjemahan.sendKomentarTranskripNilai');
Route::patch('penerjemahan-send-komentar3/{id_ijazah}', [PenerjemahanAdminController::class, 'sendKomentarIjazah'])->name('penerjemahan.sendKomentarIjazah');
Route::patch('penerjemahan-send-komentar4/{id_jurnal}', [PenerjemahanAdminController::class, 'sendKomentarJurnal'])->name('penerjemahan.sendKomentarJurnal');



// SEND KOMENTAR UMUM PENERJEMAHAN
Route::patch('penerjemahan-send-komentar5/{id_abstrak_umum}', [PenerjemahanAdminController::class, 'sendKomentarAbstrakUmum'])->name('penerjemahan.sendKomentarAbstrakUmum');
Route::patch('penerjemahan-send-komentar6/{id_transkrip_nilai_umum}', [PenerjemahanAdminController::class, 'sendKomentarTranskripNilaiUmum'])->name('penerjemahan.sendKomentarTranskripNilaiUmum');
Route::patch('penerjemahan-send-komentar7/{id_ijazah_umum}', [PenerjemahanAdminController::class, 'sendKomentarIjazahUmum'])->name('penerjemahan.sendKomentarIjazahUmum');
Route::patch('penerjemahan-send-komentar8/{id_jurnal_umum}', [PenerjemahanAdminController::class, 'sendKomentarJurnalUmum'])->name('penerjemahan.sendKomentarJurnalUmum');




// PDF UMUM
Route::get('PdfDemoUmum/{id_kursus}/{id_umum_satu}/{id_umum_dua?}', [PdfUmumController::class, 'makePDF'])->name('generateUmum.pdf');
Route::get('PdfDemoUmum1/{id_abstract_umum}/{id_umum_satu}/{id_umum_dua?}', [PdfUmumController::class, 'makePDF2'])->name('generateUmum2.pdf');
Route::get('PdfDemoumum2/{id_transkrip_nilai_umum}/{id_umum_satu}/{id_umum_dua?}', [PdfUmumController::class, 'makePDF3'])->name('generateUmum3.pdf');
Route::get('PdfDemoUmum3/{id_ijazah_umum}/{id_umum_satu}/{id_umum_dua?}', [PdfUmumController::class, 'makePDF4'])->name('generateUmum4.pdf');
Route::get('PdfDemoUmum4/{id_jurnal_umum}/{id_umum_satu}/{id_umum_dua?}', [PdfUmumController::class, 'makePDF5'])->name('generateUmum5.pdf');
Route::get('penerjemahan-admin-abstrak-umum-edit/{id_penerjemahan_umum}/{id_umum}', [PenerjemahanAdminController::class, 'editPageAbstrakUmum'])->name('penerjemahan-admin.editPageAbstrakUmum');
Route::get('penerjemahan-admin-jurnal-umum-edit/{id_jurnal_umum}/{id_umum}', [PenerjemahanAdminController::class, 'editPageJurnalUmum'])->name('penerjemahan-admin.editPageJurnalUmum');
Route::patch('penerjemahan-admin-abstrakUmum/{id_abstrak_umum}/{id_umum}', [PenerjemahanAdminController::class, 'updatePartialAbstrakUmum'])->name('penerjemahan-admin.updatePartialAbstrakUmum');
Route::patch('penerjemahan-admin-jurnalUmum/{id_jurnal_umum}/{id_umum}', [PenerjemahanAdminController::class, 'updatePartialJurnalUmum'])->name('penerjemahan-admin.updatePartialJurnalUmum');

// Delete Penerjemahan Mahasiswa
// Route::delete('penerjemahan-admin-deleteAbstrakMahasiswa/{id_mahasiswa}/{id_abstrak}', [PenerjemahanAdminController::class, 'deleteAbstrakMahasiswa'])->name('penerjemahan.deleteAbstrakMahasiswa');
// Route::delete('penerjemahan-admin-deleteTranskripMahasiswa/{id_mahasiswa}/{id_transkrip_nilai}', [PenerjemahanAdminController::class, 'deleteTranskripMahasiswa'])->name('penerjemahan.deleteTranskripMahasiswa');
// Route::delete('penerjemahan-admin-deleteIjazahMahasiswa/{id_mahasiswa}/{id_ijazah}', [PenerjemahanAdminController::class, 'deleteIjazahMahasiswa'])->name('penerjemahan.deleteIjazahMahasiswa');
// Route::delete('penerjemahan-admin-deleteJurnalMahasiswa/{id_mahasiswa}/{id_jurnal}', [PenerjemahanAdminController::class, 'deleteJurnalMahasiswa'])->name('penerjemahan.deleteJurnalMahasiswa');

// // Delete Penerjemahan Umum
// Route::delete('penerjemahan-admin-deleteAbstrakUmum/{id_umum}/{id_abstrak_umum}', [PenerjemahanAdminController::class, 'deleteAbstrakUmum'])->name('penerjemahan.deleteAbstrakUmum');
// Route::delete('penerjemahan-admin-deleteTranskripUmum/{id_umum}/{id_transkrip_nilai_umum}', [PenerjemahanAdminController::class, 'deleteTranskripUmum'])->name('penerjemahan.deleteTranskripUmum');
// Route::delete('penerjemahan-admin-deleteIjazahUmum/{id_umum}/{id_ijazah_umum}', [PenerjemahanAdminController::class, 'deleteIjazahUmum'])->name('penerjemahan.deleteIjazahUmum');
// Route::delete('penerjemahan-admin-deleteJurnalUmum/{id_umum}/{id_jurnal_umum}', [PenerjemahanAdminController::class, 'deleteJurnalUmum'])->name('penerjemahan.deleteJurnalUmum');

// DEACTIVE MAHASISWA
Route::patch('penerjemahan-deactiveAbstrak/{id_abstrak}', [PenerjemahanAdminController::class, 'deactiveAbstrak'])->name('penerjemahan.deactiveAbstrak');
Route::patch('penerjemahan-deactiveTranskrip/{id_transkrip_nilai}', [PenerjemahanAdminController::class, 'deactiveTranskripNilai'])->name('penerjemahan.deactiveTranskripNilai');
Route::patch('penerjemahan-deactiveIjazah/{id_ijazah}', [PenerjemahanAdminController::class, 'deactiveIjazah'])->name('penerjemahan.deactiveIjazah');
Route::patch('penerjemahan-deactiveJurnal/{id_jurnal}', [PenerjemahanAdminController::class, 'deactiveJurnal'])->name('penerjemahan.deactiveJurnal');




// DEACTIVE UMUM
Route::patch('penerjemahan-deactiveAbstrakUmum/{id_abstrak_umum}', [PenerjemahanAdminController::class, 'deactiveAbstrakUmum'])->name('penerjemahan.deactiveAbstrakUmum');
Route::patch('penerjemahan-deactiveTranskripUmum/{id_transkrip_nilai_umum}', [PenerjemahanAdminController::class, 'deactiveTranskripNilaiUmum'])->name('penerjemahan.deactiveTranskripNilaiUmum');
Route::patch('penerjemahan-deactiveIjazahUmum/{id_ijazah_umum}', [PenerjemahanAdminController::class, 'deactiveIjazahUmum'])->name('penerjemahan.deactiveIjazahUmum');
Route::patch('penerjemahan-deactiveJurnalUmum/{id_jurnal_umum}', [PenerjemahanAdminController::class, 'deactiveJurnalUmum'])->name('penerjemahan.deactiveJurnalUmum');



// SUPER ADMIN
Route::resource('super-admin', SuperAdminController::class);
Route::resource('listAkunMahasiswa', ListAkunMahasiswaController::class);
