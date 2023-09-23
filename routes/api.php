<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('post/all',[PostController::class,'all'])->name('post.all');
//Route::get('post/slug/{slug}',[PostController::class,'slug'])->name('post.slug');
//segunda forma
Route::get('post/slug/{post:slug}',[PostController::class,'slug'])->name('post.slug');


Route::get('category/slug/{slug}',[CategoryController::class,'slug'])->name('category.slug');
Route::get('category/{category}/posts',[CategoryController::class,'posts'])->name('category.posts');


Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::get('category/all',[CategoryController::class,'all'])->name('category.all');
    Route::post('post/upload/{post}',[PostController::class,'upload'])->name('post.upload');
    Route::resource('category',CategoryController::class);
    Route::resource('post',PostController::class);
});


Route::get('/vue/{n1?}/{n2?}/{n3?}',function(){
    return view('vue');
});

Route::post('user/login',[UserController::class,'login']);
Route::post('user/logout',[UserController::class,'logout']);
Route::post('user/token-check',[UserController::class,'checkToken']);