<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Category;

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
    return Inertia::render('Welcome');
});

Route::get('/admin', function () {
    return Inertia::render('Admin/AdminHomePanel');
});
