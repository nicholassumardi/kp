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

// FRONTPAGES
Route::view('/', 'frontpages.home.index');
Route::view('register', 'frontpages.account.register.index')->name('register');
Route::view('sign_in', 'frontpages.account.sign-in.index')->name('sign-in');

// DASHBOARD STUDENT
Route::view('student', 'student.main.dashboard');
Route::view('profile', 'student.main.profile');
Route::view('schedules', 'student.main.schedules');
Route::view('registerCourses', 'student.main.registerCourses');

// DASHBOARD ADMIN
Route::view('admin', 'admin.main.dashboard');
Route::view('profileAdmin', 'admin.main.profile');
Route::view('addSchedules', 'admin.main.schedules');
Route::view('addCourse', 'admin.main.course');
Route::view('addNews', 'admin.main.news');


