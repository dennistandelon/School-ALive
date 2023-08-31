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

Route::get('/', [\App\Http\Controllers\CourseController::class,'index']);
Route::get('/admin', [\App\Http\Controllers\CourseController::class,'admin']);
Route::get('/admin/update/{id}', [\App\Http\Controllers\CourseController::class,'adminUp']);

Route::post('/course/new',[\App\Http\Controllers\CourseController::class,'createCourse']);
Route::post('/course/update',[\App\Http\Controllers\CourseController::class,'updateCourse']);

Route::post('/detail/new',[\App\Http\Controllers\DetailController::class,'createDetail']);
Route::post('/detail/delete/{id}',[\App\Http\Controllers\DetailController::class,'deleteDetail']);
