<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CRUDController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Admin Controllers Route
Route::post('adminRegister', [AdminController::class,'adminRegister'])->name('adminRegister');
Route::post('adminLog', [AdminController::class,'adminLog'])->name('adminLog');
Route::view('adminLog','Admin.login')->name('adminLog');

Route::group(['middleware' => 'admin:admin-api'], function ($router) {
    Route::post('adminLogout', [AdminController::class,'adminLogout'])->name('adminLogout');
    Route::post('me', [AdminController::class,'me']);

});

//User contrpller routes
Route::post('userRegister', [UserController::class,'userRegister'])->name('userRegister');
Route::post('userLog', [UserController::class,'userLog'])->name('userLog');

Route::group(['middleware' => 'auth:user-api'], function ($router) {
    Route::post('userLogout', [UserController::class,'userLogout'])->name('userLogout');
    Route::post('userMe', [UserController::class,'userMe']);

});
//CRUD operation
Route::group(['middleware' => 'auth:user-api'], function ($router) {
    Route::controller(CRUDController::class)->group(function(){
        Route::get('showBlog','viewBlog');
        Route::post('addBlog','saveBlog');
        Route::get('edit/{id?}','getBlog');
        Route::put('editBlog','updateBlog');
        Route::delete('deleteBlog/{id}','deleteBlog');
    });
});

