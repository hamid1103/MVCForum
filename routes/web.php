<?php

use App\Models\Post;
use App\Models\UserSettings;
use Illuminate\Support\Facades\Auth;
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
| ToDo: Group routes
|
*/

Route::get('/', function () {
    $Categories = Category::all();

    $user = Auth::user();
    if($user!==null){
        $settings = UserSettings::where('user_id', $user->id)->get();
        $hideNSFW = $settings[0]->hideNSFW;

        if ($hideNSFW === 1) {
            $Topics = Topic::where('nsfw', '=', '0')->get();
        } else {
            $Topics = Topic::all();
        }
    }else{
        $Topics = Topic::where('nsfw', '=', '0')->get();
    }

    return Inertia::render('Welcome', ['topics' => $Topics, 'categories' => $Categories]);
});

Route::get('/settings', [\App\Http\Controllers\UserModelController::class, 'edit']);
Route::post('/updateBio', [\App\Http\Controllers\UserModelController::class, 'updateBio']);
Route::post('/updateStatus', [\App\Http\Controllers\UserModelController::class, 'updateStatus']);
Route::post('/updateSettings', [\App\Http\Controllers\UserModelController::class, 'updateSettings']);

Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index']);

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
Route::get('/topic/{tid}/newPost', [\App\Http\Controllers\PostsController::class, 'newPost']);


//misc links
Route::get('/about', function () {
    return Inertia::render('About');
});
