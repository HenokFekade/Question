<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/deactivated', 'UserController@deactivatedUsers')->name('user.deactivated.index');

Route::get('/user/deactivated/{user_name}', 'UserController@showDeactivatedUser')->name('user.deactivated.show');

Route::get('/user/activate/{user_name}', 'UserController@activateUser')->name('user.activate');

Route::resource('user', 'UserController');

Route::resource('question', 'QuestionController');

Route::resource('subject', 'SubjectController');

Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');

Route::post('profile/update', 'ProfileController@update')->name('profile.update');

Route::get('grade', 'GradeController@index')->name('grade.index');

Route::get('grade/{grade}', 'GradeController@show')->name('grade.show');


