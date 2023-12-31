<?php

use App\Models\Post;
use App\Models\UserSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Storage;

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

    if(Storage::exists('public/frontpage.doca')){
        $frontpage = Storage::read('public/frontpage.doca');
    }else{
        $frontpage = 404;
    }

    return Inertia::render('Welcome', ['topics' => $Topics, 'categories' => $Categories, 'frontpage'=>$frontpage]);
});

Route::get('/settings', [\App\Http\Controllers\UserModelController::class, 'edit']);
Route::post('/updateBio', [\App\Http\Controllers\UserModelController::class, 'updateBio']);
Route::post('/updateStatus', [\App\Http\Controllers\UserModelController::class, 'updateStatus']);
Route::post('/updateSettings', [\App\Http\Controllers\UserModelController::class, 'updateSettings']);

Route::middleware('can:update-server')->controller(\App\Http\Controllers\AdminController::class)->group(function (){
    Route::post('/updateFrontPage', 'saveFrontPageContent');
    Route::get('/admin', 'index');
    Route::get('/admin/siteSettings', 'SiteSettings');
    Route::get('/admin/roles', 'roles');
    Route::get('/admin/tags','tags');
    Route::get('/admin/topics','topics');
    Route::get('/admin/categories', 'categorie');
});

Route::middleware('can:update-site')->post('/makeTag', [\App\Http\Controllers\PostsController::class, 'makeTag']);
Route::middleware('can:update-site')->post('/makeCat', [\App\Http\Controllers\AdminController::class, 'makeCat']);



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
Route::post('/updatePost', [\App\Http\Controllers\PostsController::class, 'updatePost']);

Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

Route::get('/post/{id}', [\App\Http\Controllers\PostsController::class, 'show']);
Route::get('/post/{id}/{page}', [\App\Http\Controllers\PostsController::class, 'show']);

Route::post('/reply/create', [\App\Http\Controllers\ReplyController::class,'CreateReply']);

Route::post('/signin', [\App\Http\Controllers\AuthController::class, 'authenticate']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'createUser']);

Route::get('/topic/{tid}', [\App\Http\Controllers\TopicsController::class, 'show']);
Route::get('/topic/{tid}/newPost', [\App\Http\Controllers\PostsController::class, 'newPost']);

Route::post('/PostImageUpload', [\App\Http\Controllers\FileController::class, 'PostImageFromUpload']);
Route::post('/PostImageURL', [\App\Http\Controllers\FileController::class, 'PostImageFromUrl']);
Route::post('/likePost', [\App\Http\Controllers\PostsController::class, 'likePost']);
Route::get('/getLike/{pid}', [\App\Http\Controllers\PostsController::class, 'getLike']);

Route::post('/createTopic', [\App\Http\Controllers\TopicsController::class, 'newTopic']);

Route::get('/getTags', [\App\Http\Controllers\PostsController::class, 'getTags']);
Route::get('/getTags/{s}', [\App\Http\Controllers\PostsController::class, 'getTags']);
Route::get('/getCats', [\App\Http\Controllers\TopicsController::class, 'getCats']);
Route::get('/getCats/{s}', [\App\Http\Controllers\TopicsController::class, 'getCats']);
Route::get('/getPostTags/{id}', [\App\Http\Controllers\PostsController::class, 'getPostTags']);
Route::get('/posts', [\App\Http\Controllers\PostsController::class, 'getPosts']);

//misc links
Route::get('/about', function () {
    return Inertia::render('About');
});
