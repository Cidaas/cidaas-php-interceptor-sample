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

Route::get('/myprofile', "RestController@MyProfile");

Route::get('/employeelist', "RestController@EmployeeList");

Route::get('/holidaylist', "RestController@HolidayList");

Route::get('/localholidaylist', "RestController@LocalHolidayList");

Route::get('/leavetype', "RestController@LeaveType");
