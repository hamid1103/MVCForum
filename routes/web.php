<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $Categories = Category::all();
    $Topics = Topic::all();
    return Inertia::render('Welcome', ['topics' => $Topics, 'categories'=>$Categories]);
});

Route::get('/admin', function () {
    return Inertia::render('Admin/AdminHomePanel');
});

Route::get('/signin', function () {
    return Inertia::render('SignIn');
});

Route::get('/email/verify', function () {
    return Inertia::render('EmailVerification/CheckEmailVerification');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    //ToDo: Add verified user role using bouncer.


    return Inertia::render('EmailVerification/EmailVerified');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('/createPost', [\App\Http\Controllers\PostsController::class, 'createPost']);

Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

Route::get('/post/{id}', [\App\Http\Controllers\PostsController::class, 'show']);

Route::post('/signin', [\App\Http\Controllers\AuthController::class, 'authenticate']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'createUser']);

Route::get('/topic/{tid}', [\App\Http\Controllers\TopicsController::class, 'show']);
Route::get('/topic/{tid}/newPost', [\App\Http\Controllers\TopicsController::class, 'newPost']);


//misc links
Route::get('/about', function (){
    return Inertia::render('About');
});
