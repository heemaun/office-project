<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommetController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\TestsEnrollmentController;
use App\Mail\SampleMail;
use App\Mail\WelcomeMail;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
//     $posts = Post::all();
//     return view('home',compact('posts'));
// });

Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/all-posts',[PostController::class,'index2'])->name('all-posts');
Route::resource('/posts', PostController::class)->scoped([
    'post' => 'slug'
]);
Route::resource('/comments', CommetController::class)->only('store')->middleware('user');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/user-control',[HomeController::class,'userControl'])->name('assign.role');
    route::get('/edit-user/{user}',[HomeController::class,'editUser'])->name('user.edit');
    route::post('/user-update/{id}',[HomeController::class,'updateUser'])->name('user.update');
});

// Route::get('email', function() {
//     Mail::to('heemaun@gmail.com')->send(new WelcomeMail);
//     return new WelcomeMail();
// });

Route::get('/email',[EmailController::class,'email']);

Route::get('/send-testenrollment',[TestsEnrollmentController::class,'sendTestNotification']);

Route::get('/sms',[SmsController::class,'index']);

Route::get('/send-mail',function(){
    $users = User::all();
    return view('create-mail',compact('users'));
})->name('mails.create');

Route::post('/email-markdown/{email}',[EmailController::class,'sendEmail'])->name('send.mail');
