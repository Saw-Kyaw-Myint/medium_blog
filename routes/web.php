<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('index');
// })->name('index');

//Authentication
Route::get('/login', [LoginController::class, 'create'])->name('login.create');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

//post
Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/home/{category}',[CategoryController::class,'search'])->name('home.search');
// Route::get('/post/{id}',[PostController::class,'show'])->name('post.show');
Route::get('/post',[PostController::class,'index'])->name('post.index');


//User
Route::group(['middleware' => ['user']], function () {
    Route::get('/post/create',[PostController::class,'create'])->name('post.create');
    Route::post('/post',[PostController::class,'store'])->name('post.store');
    Route::get('/post/edit/{id}',[PostController::class,'edit'])->name('post.edit');
    Route::get('/post/home/{id}',[PostController::class,'show'])->name('post.show');
    Route::put('post/{id}',[PostController::class,'update'])->name('post.update');
    Route::delete('post/{id}',[PostController::class,'destroy'])->name('post.destroy');

    Route::delete('profile/{id}', [PostController::class, 'profileDel'])->name('profile.delete');
    Route::get('users/', [UserController::class, 'index'])->name('user.profile');

//commentpo
    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.add');
    Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.add');
    Route::put('updateComment/{id}',[CommentController::class,'updateComment'])->name('comment.update');
    Route::get('/delete/{id}', [CommentController::class,'delete'])->name('comment.delete');

    Route::post('/userProfile', [UserController::class, 'update'])->name('user.update');
    Route::post('/changePassword/update', [UserController::class, 'updatePassword'])->name('update.password');
    Route::get('/{category}',[CategoryController::class,'search'])->name('category.search');
});
