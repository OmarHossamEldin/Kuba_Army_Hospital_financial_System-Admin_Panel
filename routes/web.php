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

Route::group(['middleware' => ['auth']], function () {

    Route::get('safetyQuestion','GateController@safetyQuestion')->name('safetyQuestion'); // safetyQuestion form to get key and answer for safety

    Route::post('safetyQuestion','GateController@sQstore')->name('answerStore');; // answering safetyQuestion to get key and answer for safety

});

Route::group(['middleware' => ['auth', 'SaftyQuestion']], function () {

    Route::get('user/create','UserController@create')->name('user.create'); // to get form for creating new user

    Route::post('user','UserController@store')->name('user.register'); // to create new user

    Route::get('user','UserController@index')->name('user.all'); // all users

    Route::get('user/{user}/edit ','UserController@edit')->name('user.edit'); // get user form for editing user

    Route::patch('user/{user} ','UserController@update')->name('user.update'); // get user form for updating user data

    Route::get('search/{username}','UserController@search')->name('search.username'); // filter using search box for all users table

    Route::get('dashboard','GateController@dashboard')->name('dashboard'); // dashboard for all users

    Route::get('logout','GateController@logout')->name('logout'); // log out from the system

    Route::get('patient','PatientController@index')->name('patient.all');// get patient view search

    Route::get('patient/{patient}','PatientController@search_patient')->name('search.patient'); // filtering patients table

    Route::get('patient/{patient}/edit','PatientController@edit')->name('patient.edit'); // getting data from patients table

    Route::patch('patient/{patient}','PatientController@update')->name('patient.update'); // update data to patient table

    Route::delete('patient/{patient}','PatientController@destroy')->name('patient.destroy'); // delete from patient table

    Route::get('relate/{patient}','PatientController@search_parent')->name('patient.search_parent'); // search_parent data for patient table

    Route::get('relate/{patient}/confirm','PatientController@parent_info')->name('patient.info'); // info date for patient table

    Route::get('visitin','VisitInController@index')->name('visitin.all');// get visitin view search

    Route::get('visitin/{key}','VisitInController@get_visitIns')->name('visitin.key'); // key refer to patient for visitIn

    Route::get('visitIn/{visitIn}/edit','VisitInController@edit')->name('visitin.edit'); // view edit for visitIn &walletdetails

    Route::patch('date/{visitIn}','VisitInController@update_date')->name('date.update'); // update for visitIn dates

    Route::patch('visitIn/{visitIn}','VisitInController@update')->name('visitin.update'); // update for visitIn &walletdetails

    Route::patch('morafek/{Morafek}','MorafeksController@update_date')->name('MorafekDates.update'); //update Morafek Dates 

    Route::patch('morafek/service/{Morafek}','MorafeksController@update_service')->name('MorafekService.update'); //update Morafek Service 

    Route::patch('morafek/balance/{Morafek}','MorafeksController@update_balance')->name('MorafekBalance.update'); //update Morafek Balance 

    Route::delete('morafek/{Morafek}','MorafeksController@destroy')->name('Morafek.delete'); //delete Morafek From VisitIn  And Substract His Balance From VisitIn

});


Route::group(['middleware' => 'guest'], function () {

    Route::post('login','GateController@login')->name('login');  // to auth and login to the system

    Route::get('/','GateController@welcomepage');      //to welcome page

    Route::get('login','GateController@getloginform')->name('user.login');  // to get login form

    Route::get('forgetPassword','GateController@forgepatPasswordForm')->name('forgetPassword');  // forgetPasswordForm

    Route::get('forgetPassword/{username}','GateController@forgetPasswordUsername')->name('forgetPasswordUsername');  // check if username has SQ or not if he has return with the question

    Route::get('confirmAnswer/{username}/{answer}/','GateController@confirmAnswer')->name('confirmAnswer');  // confirm answer

    Route::get('changingPassword/{username}','GateController@changingPassword')->name('changingPassword');  // changing Password

    Route::post('newPassword','GateController@newPassword')->name('newPassword');  // creating  newPassword 

});


