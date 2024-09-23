<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Login\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Открываем доступ к странице регистрации только для гостей
Route::middleware('guest')->group(function() {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

});


// роут для выхода из аккаунта 
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// // роут главной стран це пользователя с приветствием
Route::get('/home', function (){
    return view('home');
})->name('home');


