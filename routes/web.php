<?php

use App\Http\Middleware\HakAkses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MyCourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\PaymentCallbackController;

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

// Route::get('/', [WelcomeController::class,'index']);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/courses', [UserCourseController::class,'index'])->name('courses.index');
Route::get('/courses/{slug}', [UserCourseController::class,'show'])->name('courses.show');
Route::post('/handle-notification', [PaymentCallbackController::class, 'receive']);
Route::resource('/cart', CartController::class)->only('update', 'delete');
Route::resource('/order', OrderController::class)->only('update');
Route::resource('/mycourse', MycourseController::class)->only(['store']);
Auth::routes();

Route::group(['middleware'=> 'auth'], function() {
Route::group(['middleware' => 'hakakses:admin'], function(){
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/admin/level', LevelController::class);
    Route::resource('/admin/lesson', LessonController::class);
    Route::resource('/admin/course', CourseController::class);
    Route::resource('/admin/price', PriceController::class);
    Route::get('/admin/profile', [ProfileController::class, 'adminV'])->name('profiladmin');
    Route::put('/admin/profile/{user}', [ProfileController::class, 'adminUpdate'])->name('profiladmin.update');
    Route::resource('/admin/users', UserController::class);
    Route::get('/admin/users-admin', [UserController::class, 'indexAdmin'])->name('useradmin');
    Route::get('/admin/users-user', [UserController::class, 'indexUser'])->name('userindex');
    Route::get('/admin/users-murid', [UserController::class, 'indexMurid'])->name('usermurid');
 });
 Route::group(['middleware' => 'hakakses:user,admin,murid'], function(){
    Route::resource('/mycourse', MyCourseController::class);
    Route::post('/mycourse/{course_id}/rating', [MyCourseController::class, 'rating'])->name('mycourse.rating');
    Route::get('/mycourse/lesson/{slug}', [LessonController::class,'usershow'])->name('lesson.user.show');
    Route::get('/mycourse/{course_id}/lesson', [LessonController::class,'indexuser'])->name('lesson.user.index');
    Route::resource('/cart', CartController::class);
    Route::resource('/order', OrderController::class);
    Route::post('/course/komen', [UserCourseController::class, 'comment'])->name('course.comment');
    Route::resource('/course/comment', CommentController::class);
    Route::post('/lesson/check', [LessonController::class,'completion'])->name('lesson.user.completion');
    Route::get('/user/profile', [ProfileController::class, 'userV'])->name('profileuser');
    Route::put('/user/profile/{user}', [ProfileController::class, 'userUpdate'])->name('profileuser.update');
    Route::post('/sertif', [SertifikatController::class, 'process'])->name('sertif');
 });

});
