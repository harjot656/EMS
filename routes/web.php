<?php

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
    return view('login');
});

Route::post('login','HomeController@login')->name('login');

Route::get('test','HomeController@index');

Route::get('index','HomeController@showIndex')->name('index');
// Route::get('holidays','HomeController@holiday')->name('holidays');
Route::get('leave-requests','HomeController@leaveRequest')->name('leave-requests');
Route::get('attendance','HomeController@showAttendance')->name('attendance');
Route::get('departments','HomeController@showDepartment')->name('departments');
Route::get('designations','HomeController@showDesignation')->name('designations');
Route::get('profile','HomeController@getProfile')->name('profile');
Route::get('edit-profile','HomeController@editProfile')->name('edit-profile');
// Route::get('add-employee','HomeController@addEmployee')->name('add-employee');
Route::get('generate_report','HomeController@generateReport')->name('generate-report');

Route::post('saveEmployee','HomeController@saveEmployee')->name('saveEmployee');
Route::post('performLogin','HomeController@performLogin')->name('performLogin');
Route::get('add-attendance','HomeController@addAttendance')->name('add-attendance');

Route::get('add-attendance2','HomeController@addAttendance2')->name('add-attendance2');

Route::post('getTime','HomeController@getTime')->name('getTime');
Route::post('saveAttendance','HomeController@saveAttendance')->name('saveAttendance');
Route::post('prevNextWeek','HomeController@prevNextWeek');

Route::get('add-attendance3','HomeController2@addAttendance3')->name('add-attendance3');
Route::post('saveAttendance2','HomeController2@saveAttendance2')->name('saveAttendance2');
Route::post('prevNextWeek2','HomeController2@prevNextWeek2');
Route::post('editEmployee','HomeController@editEmployee')->name('editEmployee');
Route::post('removeEmployee','HomeController@removeEmployee')->name('removeEmployee');

Route::post('get_report','HomeController@get_report')->name('get_report');

Route::post('firstDiv','HomeController2@firstDiv')->name('firstDiv');