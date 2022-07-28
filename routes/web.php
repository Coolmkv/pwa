<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomePageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
Route::get("/",[HomePageController::class,"homePage"]);
Route::get("adminLogin",[AdminController::class,"adminLogin"]);
Route::get('/dashboard', function () {
    //return view("Dashboard.dashboard_home");
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 

Route::get("new-dashboard",[AdminController::class,"dashboard"])->name("dashboard");
Route::get("site-navigation",[AdminController::class,"siteNav"])->name("siteNav");
require __DIR__.'/auth.php';
