<?php

use App\Http\Controllers\ActivityScheduleController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RegistrantController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//== HALAMAN PUBLIK (USER) ==//
Route::view('/', 'layouts.index')->name('index');
Route::view('/about', 'layouts.about')->name('about');
Route::view('/activities', 'layouts.activities')->name('activities');
Route::view('/goods', 'layouts.goods')->name('goods');
Route::view('/contact', 'layouts.contact')->name('contact');
Route::view('/clients', 'layouts.clients')->name('clients');
Route::view('/installation', 'layouts.installation')->name('installation');
Route::view('/article', 'layouts.article')->name('article');
Route::view('/done', 'registration.done')->name('done');

//== HALAMAN LOGIN & SCAN ==//
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::view('/choose', 'login.choose');
Route::view('/activity', 'login.activity');
Route::view('/scan', 'login.scan');
Route::view('/finishScan', 'login.finishScan');
Route::view('/errorScan', 'login.errorScan');


//== PROSES REGISTRASI PENGGUNA ==//
Route::controller(RegistrationController::class)->group(function () {
    Route::get('/registration', 'showStep1')->name('registration'); 
    Route::prefix('registration')->name('registration.')->group(function() {
        Route::get('/get-dates', 'getDates')->name('getDates');
        Route::get('/get-times', 'getTimes')->name('getTimes');
    });
    Route::get('/registration/step2/{schedule}', 'showStep2')->name('registration.showStep2');
    Route::post('/registration/step2/{schedule}', 'storeStep2')->name('registration.storeStep2');
    Route::get('/registration/step3', 'showStep3')->name('registration.step3');
    Route::post('/registration/step3', 'storeStep3')->name('registration.storeStep3');
});


//======================================================================
//==                       AREA ADMIN (WAJIB LOGIN)                   ==
//======================================================================
Route::prefix('admin')->name('admin.')->group(function () { 

    Route::resource('activity-schedules', ActivityScheduleController::class)->except(['create', 'show']);
    Route::get('activity-schedules/{activitySchedule}/participants', [ActivityScheduleController::class, 'participants'])->name('activity-schedules.participants');
    Route::resource('activities', ActivityController::class)->except(['create', 'show']);
    Route::resource('administrators', AdministratorController::class)->except(['create', 'show']);

    // Route untuk Manajemen Pendaftar
    Route::get('/registrants', [RegistrantController::class, 'index'])->name('registrants');
    Route::get('/new-registrations', [RegistrantController::class, 'showNew'])->name('registrations.new');
    
    // PERBAIKAN: Route '/participants' sekarang menjadi resource
    Route::resource('participants', ParticipantController::class)->except(['create', 'show']);
    
    // Route statis admin lainnya
    Route::view('/detail-attendance', 'admin.scheduleRegistration.detailAttendance')->name('detailAttendance');
    
    // Route API untuk filter dinamis di halaman registrants
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/registrants/dates', [RegistrantController::class, 'getDates'])->name('registrants.getDates');
        Route::get('/registrants/times', [RegistrantController::class, 'getTimes'])->name('registrants.getTimes');
        Route::get('/registrants/data', [RegistrantController::class, 'getRegistrants'])->name('registrants.getData');
    });

});
