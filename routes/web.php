<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('registration.registration1');
})->name('registration.step1'); 

Route::get('/2', function () {
    return view('registration.registration2');
})->name('registration.step2'); 

Route::get('/3', function () {
    return view('registration.registration3');
})->name('registration.step3');

Route::get('/done', function () {
    return view('registration.done');
});

Route::get('/login', function () {
    return view('login.login');
});

Route::get('/choose', function () {
    return view('login.choose');
});

Route::get('/activity', function () {
    return view('login.activity');
});

Route::get('/scan', function () {
    return view('login.scan');
});

Route::get('/finishScan', function () {
    return view('login.finishScan');
});

Route::get('/errorScan', function () {
    return view('login.errorScan');
});

//SCHEDULE & REGISTRATION
Route::get('/activitySchedule', function () {
    return view('admin.scheduleRegistration.activitySchedule');
});

Route::get('/registration', function () {
    return view('admin.scheduleRegistration.registration');
});

Route::get('/detailAttendance', function () {
    return view('admin.scheduleRegistration.detailAttendance');
});

Route::get('/registrants', function () {
    return view('admin.scheduleRegistration.registrants');
});

//USERS & ACTIVITIES
Route::get('/activitiesDatabase', function () {
    return view('admin.userActivities.activitiesDatabase');
});

Route::get('/administration', function () {
    return view('admin.userActivities.administration');
});


//PARTICIPANTS
Route::get('/participants', function () {
    return view('admin.participants.participants');
});