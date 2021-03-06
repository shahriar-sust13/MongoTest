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
	if( Auth::check() ){
		return redirect('profile/'.Auth::user()->_id);
	}
    return view('auth.login');
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

Route::get('/download/{file_id}', 'FileController@downloadFile');

Route::post('/question-post/{course_id}', 'QuestionController@addQuestion');

Route::get('/question/{id}', 'QuestionController@showQuestion');

Route::post('/post-answer/{question_id}', 'QuestionController@addAnswer');

Route::get('/profile/{id}', 'ProfileController@showProfile');

Route::post('/point/{type}/{post_id}', 'PointController@addPoint');