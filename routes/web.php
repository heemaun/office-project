<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommetController;
use App\Models\Post;

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
    $posts = Post::all();
    return view('home',compact('posts'));
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/posts', PostController::class)->scoped([
    'post' => 'slug'
]);
Route::resource('/comments', CommetController::class)->only('store')->middleware('user');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/user-control',[HomeController::class,'userControl'])->name('assign.role');
    route::get('/edit-user/{user}',[HomeController::class,'editUser'])->name('user.edit');
    route::post('/user-update/{id}',[HomeController::class,'updateUser'])->name('user.update');
});
