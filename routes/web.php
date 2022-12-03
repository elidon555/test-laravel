<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailFormController;

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

Route::get('/welcome', function () {
    return view('index');
})->name('home');

Route::get('/schedule-email', function () {
    return view('email-send-form/index');
})->name('email.schedule');

Route::resource('mail', MailFormController::class);
//Route::post('/mail/store', [MailFormController::class, 'store'])->name('mail.store');

