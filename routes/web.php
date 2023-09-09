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


//Admin -  COURSES
Route::get('/admin', [\App\Http\Controllers\CourseController::class,'admin'])->middleware('security');
Route::get('/admin/update/{id}', [\App\Http\Controllers\CourseController::class,'adminUp'])->middleware('security');
Route::get('/admin/search/', [\App\Http\Controllers\CourseController::class,'adminSearch'])->middleware('security');

Route::post('/course/new',[\App\Http\Controllers\CourseController::class,'createCourse'])->middleware('security');
Route::post('/course/update',[\App\Http\Controllers\CourseController::class,'updateCourse'])->middleware('security');
Route::delete('/course/delete/{id}',[\App\Http\Controllers\CourseController::class,'deleteCourse'])->middleware('security');

Route::post('/detail/new',[\App\Http\Controllers\DetailController::class,'createDetail'])->middleware('security');
Route::post('/detail/delete/{id}',[\App\Http\Controllers\DetailController::class,'deleteDetail'])->middleware('security');

//Admin - LECTURER
Route::get('/admin-lecturer', [\App\Http\Controllers\LecturerController::class,'admin'])->middleware('security');
Route::get('/admin-lecturer/update/{id}',[\App\Http\Controllers\LecturerController::class,'adminUp'])->middleware('security');

Route::post('/lecturer/new',[\App\Http\Controllers\LecturerController::class,'insertLecturer'])->middleware('security');
Route::post('/lecturer/update/',[\App\Http\Controllers\LecturerController::class,'insertLecturer'])->middleware('security');
Route::delete('/lecturer/delete/{id}',[\App\Http\Controllers\LecturerController::class,'deleteLecturer'])->middleware('security');

//Admin - STUDENT
Route::get('/admin-student', [\App\Http\Controllers\StudentController::class,'admin'])->middleware('security');
Route::get('/admin-student/update/{id}',[\App\Http\Controllers\StudentController::class,'adminUp'])->middleware('security');
Route::delete('/admin-student/delete/{id}',[\App\Http\Controllers\StudentController::class,'deleteStudent'])->middleware('security');

Route::post('/student/new',[\App\Http\Controllers\StudentController::class,'insertStudent'])->middleware('security');


// Student
Route::get('/student/{id}', [\App\Http\Controllers\StudentController::class,'index'])->middleware('security');


// Lecturer
Route::get('/lecturer/{id}', [\App\Http\Controllers\LecturerController::class,'index'])->middleware('security');

