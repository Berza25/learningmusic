<?php

use App\Http\Middleware\HakAkses;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\UserCourseController;

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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::group(['middleware'=> 'auth'], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'hakakses:admin'], function(){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::resource('/level', LevelController::class);
    Route::resource('/materi', MateriController::class);
    Route::resource('/price', PriceController::class);
 });
 Route::group(['middleware' => 'hakakses:user'], function(){
     Route::get('/courses', [UserCourseController::class,'index']);
     Route::get('/courses/{slug}', [UserCourseController::class,'show'])->name('courses.show');
 });
    
});