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

Route::post('saveEmployee','HomeController@saveEmployee')->name('saveEmployee');
Route::post('performLogin','HomeController@performLogin')->name('performLogin');