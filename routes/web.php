<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Topic;

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

Route::post('/createPost', [\App\Http\Controllers\PostsController::class, 'createPost']);

Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

Route::get('/post/{id}', [\App\Http\Controllers\PostsController::class, 'show']);

Route::post('/signin', [\App\Http\Controllers\AuthController::class, 'authenticate']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'createUser']);

Route::get('/topic/{tid}', [\App\Http\Controllers\TopicsController::class, 'show']);
Route::get('/topic/{tid}/newPost', [\App\Http\Controllers\TopicsController::class, 'newPost']);
