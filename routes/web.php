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

// Auth
Route::get('/',[\App\Http\Controllers\AuthController::class,'loginPage']);
Route::get('/login',[\App\Http\Controllers\AuthController::class,'login']);
Route::get('/logout',[\App\Http\Controllers\AuthController::class,'logout']);
Route::get('/profile',[\App\Http\Controllers\AuthController::class,'profile']);
Route::get('/home',[\App\Http\Controllers\AuthController::class,'home']);


Route::post('/profile/update',[\App\Http\Controllers\AuthController::class,'profileUp']);


//Admin -  COURSES
Route::get('/admin', [\App\Http\Controllers\CourseController::class,'admin'])->middleware('security');
Route::get('/admin/update/{id}', [\App\Http\Controllers\CourseController::class,'adminUp'])->middleware('security');
Route::get('/admin/search/', [\App\Http\Controllers\CourseController::class,'adminSearch'])->middleware('security');

Route::get('/course/{id}',[\App\Http\Controllers\CourseController::class,'coursePage']);
Route::post('/course/new',[\App\Http\Controllers\CourseController::class,'createCourse'])->middleware('security');
Route::post('/course/update',[\App\Http\Controllers\CourseController::class,'updateCourse'])->middleware('security');
Route::delete('/course/delete/{id}',[\App\Http\Controllers\CourseController::class,'deleteCourse'])->middleware('security');

Route::post('/detail/new',[\App\Http\Controllers\DetailController::class,'createDetail'])->middleware('security');
Route::post('/detail/delete/{id}',[\App\Http\Controllers\DetailController::class,'deleteDetail'])->middleware('security');

Route::post('coursestudent/new',[\App\Http\Controllers\StudentController::class,'assignCourse'])->middleware('security');
Route::delete('coursestudent/delete/{cid}/{sid}',[\App\Http\Controllers\StudentController::class,'unassignCourse'])->middleware('security');

//Admin - LECTURER
Route::get('/admin-lecturer', [\App\Http\Controllers\LecturerController::class,'admin'])->middleware('security');
Route::get('/admin-lecturer/loginas/{id}',[\App\Http\Controllers\LecturerController::class,'adminAs'])->middleware('security');
Route::get('/admin-lecturer/search/', [\App\Http\Controllers\LecturerController::class,'adminSearch'])->middleware('security');

Route::post('/lecturer/new',[\App\Http\Controllers\LecturerController::class,'insertLecturer'])->middleware('security');
Route::post('/lecturer/update/',[\App\Http\Controllers\LecturerController::class,'insertLecturer'])->middleware('security');
Route::delete('/lecturer/delete/{id}',[\App\Http\Controllers\LecturerController::class,'deleteLecturer'])->middleware('security');

//Admin - STUDENT
Route::get('/admin-student', [\App\Http\Controllers\StudentController::class,'admin'])->middleware('security');
Route::get('/admin-student/loginas/{id}',[\App\Http\Controllers\StudentController::class,'adminAs'])->middleware('security');
Route::delete('/admin-student/delete/{id}',[\App\Http\Controllers\StudentController::class,'deleteStudent'])->middleware('security');
Route::get('/admin-student/search/', [\App\Http\Controllers\StudentController::class,'adminSearch'])->middleware('security');

Route::post('/student/new',[\App\Http\Controllers\StudentController::class,'insertStudent'])->middleware('security');


// Student
Route::get('/student/{id}', [\App\Http\Controllers\StudentController::class,'index'])->middleware('security');


// Lecturer
Route::get('/lecturer/{id}', [\App\Http\Controllers\LecturerController::class,'index'])->middleware('security');

