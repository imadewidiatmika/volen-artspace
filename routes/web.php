<?php

use App\Http\Controllers\ActivityScheduleController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

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

// USER-FACING ROUTES
Route::get('/', function () { return view('layouts.index'); })->name('index');
Route::get('/about', function () { return view('layouts.about'); })->name('about');
Route::get('/activities', function () { return view('layouts.activities'); })->name('activities');
Route::get('/goods', function () { return view('layouts.goods'); })->name('goods');
Route::get('/contact', function () { return view('layouts.contact'); })->name('contact');
Route::get('/clients', function () { return view('layouts.clients'); })->name('clients');
Route::get('/installation', function () { return view('layouts.installation'); })->name('installation');
Route::get('/article', function () { return view('layouts.article'); })->name('article');
Route::get('/registration', function () { return view('registration.registration'); })->name('registration'); 
Route::get('/registration/step2', function () { return view('registration.registration2'); })->name('registration2'); 
Route::get('/registration/step3', function () { return view('registration.registration3'); })->name('registration.step3');
Route::get('/done', function () { return view('registration.done'); });
Route::get('/login', function () { return view('login.login'); });
Route::get('/choose', function () { return view('login.choose'); });
Route::get('/activity', function () { return view('login.activity'); });
Route::get('/scan', function () { return view('login.scan'); });
Route::get('/finishScan', function () { return view('login.finishScan'); });
Route::get('/errorScan', function () { return view('login.errorScan'); });

// --------------------------------------------------------------------------
// ADMIN ROUTES
// --------------------------------------------------------------------------
Route::prefix('admin')->name('admin.')->group(function () {

    // SCHEDULE & REGISTRATION ROUTES
    Route::prefix('activity-schedules')->name('activity-schedules.')->controller(ActivityScheduleController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{activitySchedule}/edit', 'edit')->name('edit');
        Route::put('/{activitySchedule}', 'update')->name('update');
        Route::delete('/{activitySchedule}', 'destroy')->name('destroy');
        Route::get('/{activitySchedule}/participants', 'participants')->name('participants');
    });

    Route::get('/registration', function () {
        return view('admin.scheduleRegistration.registration');
    })->name('registration');

    Route::get('/detailAttendance', function () {
        return view('admin.scheduleRegistration.detailAttendance');
    })->name('detailAttendance');

    Route::get('/registrants', function () {
        return view('admin.scheduleRegistration.registrants');
    })->name('registrants');

    // USERS & ACTIVITIES ROUTES
    Route::prefix('activities')->name('activities.')->controller(ActivityController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{activity}/edit', 'edit')->name('edit');
        Route::put('/{activity}', 'update')->name('update');
        Route::delete('/{activity}', 'destroy')->name('destroy');
    });

     Route::prefix('administrators')->name('administrators.')->controller(AdministratorController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{administrator}/edit', 'edit')->name('edit');
        Route::put('/{administrator}', 'update')->name('update');
        Route::delete('/{administrator}', 'destroy')->name('destroy');
    });

    // PARTICIPANTS ROUTES
    Route::get('/participants', function () {
        return view('admin.participants.participants');
    })->name('participants');
});