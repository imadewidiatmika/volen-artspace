<?php

use App\Http\Controllers\ActivityScheduleController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//== HALAMAN PUBLIK (USER) - Dirapikan dengan Route::view ==//
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
Route::view('/login', 'login.login')->name('login');
Route::view('/choose', 'login.choose');
Route::view('/activity', 'login.activity');
Route::view('/scan', 'login.scan');
Route::view('/finishScan', 'login.finishScan');
Route::view('/errorScan', 'login.errorScan');

// HAPUS SEMUA ROUTE REGISTRASI LAMA ANDA, GANTI DENGAN BLOK INI
//== PROSES REGISTRASI PENGGUNA ==//
Route::controller(RegistrationController::class)->group(function () {
    // Rute utama untuk halaman registrasi (step 1)
    Route::get('/registration', 'showStep1')->name('registration'); 
    
    // Rute untuk AJAX requests
    Route::prefix('registration')->name('registration.')->group(function() {
        Route::get('/get-dates', 'getDates')->name('getDates');
        Route::get('/get-times', 'getTimes')->name('getTimes');
    });

    // Rute untuk menampilkan dan memproses step 2
    Route::get('/registration/step2/{schedule}', 'showStep2')->name('registration.showStep2');
    Route::post('/registration/step2', 'storeStep2')->name('registration.storeStep2');

    // Rute untuk menampilkan step 3 (misalnya halaman konfirmasi/pembayaran)
    Route::get('/registration/step3', function () {
        return view('registration.registration3');
    })->name('registration.step3');
});


//======================================================================
//==                       AREA ADMIN (WAJIB LOGIN)                   ==
//======================================================================
Route::prefix('admin')->name('admin.')->group(function () { // <-- Nanti tambahkan ->middleware('auth') di sini

    // MENGGUNAKAN Route::resource untuk admin agar lebih ringkas
    Route::resource('activity-schedules', ActivityScheduleController::class)->except(['create', 'show']);
    Route::get('activity-schedules/{activitySchedule}/participants', [ActivityScheduleController::class, 'participants'])->name('activity-schedules.participants');

    Route::resource('activities', ActivityController::class)->except(['create', 'show']);
    Route::resource('administrators', AdministratorController::class)->except(['create', 'show']);

    // Route statis admin lainnya
    Route::view('/detail-attendance', 'admin.scheduleRegistration.detailAttendance')->name('detailAttendance');
    Route::view('/registrants', 'admin.scheduleRegistration.registrants')->name('registrants');
    Route::view('/participants', 'admin.participants.participants')->name('participants');

});