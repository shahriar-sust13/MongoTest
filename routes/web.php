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
    return view('welcome');
});

Route::get('/course/{id}/{tab}', 'CourseController@showCourseProfile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', 'TestController@test');

Route::get('/addcourse', 'CourseController@showCourseForm');

Route::post('/addcourse', 'CourseController@addCourse');

Route::get('/course-request/{id}', 'CourseController@courseRequest');

Route::get('/accept/{course_id}/{user_id}', 'CourseController@acceptRequest');

Route::get('/decline/{course_id}/{user_id}', 'CourseController@declineRequest');

Route::post('/course-post/{course_id}', 'PostController@addPost');
