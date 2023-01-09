<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;


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
    return view('welcome');
});

Route::post('/register',[LoginController::class,'Register']);
Route::get('/login',[LoginController::class,'loginView']);
Route::post('/login',[LoginController::class,'login']);
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);
// Github Login Here
Route::get('sign-in/github',[LoginController::class,'github']);
Route::get('sign-in/github/redirect',[LoginController::class,'githubRedirect']);

// Google Login Here
Route::get('sign-in/google',[LoginController::class,'google']);
Route::get('sign-in/google/redirect',[LoginController::class,'googleRedirect']);

Route::get('/userdashboard/{lang?}',[UserController::class,'index']);
Route::get('/adduser',[UserController::class,'addUser']);
Route::post('/addnewuser',[UserController::class,'addnewuser']);
Route::get('/user/edit/{id}',[UserController::class,'userEdit'])->name('user.edit');
Route::post('/updateuser/{id}',[UserController::class,'updateUser']);
Route::get('/userlist',[UserController::class,'userlist']);

Route::get('/collectiveform',[UserController::class,'collectiveform']);
