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

Route::get('/','HomeController@HomeIndex');
Route::get('/visitor','VisitorController@VisitorIndex');

// Admin Panel Service Management
Route::get('/service','ServiceController@ServiceIndex');
Route::get('/getServiceData','ServiceController@getServicesData');
Route::post('/ServiceDelete','ServiceController@ServiceDelete');
Route::post('/ServiceDetails','ServiceController@getServiceDetails');
Route::post('/updatateData','ServiceController@getServiceUpdate');
Route::post('/addNewServices','ServiceController@addNewServices');

// Admin Panel Courses manaement
Route::get('/Courses','CourseController@CoursesIndex');
Route::get('/getCourseData','CourseController@getCourseData');
Route::post('/addNewCourses','CourseController@addNewCourses');
Route::post('/courseDelete','CourseController@CourseDeleted');
Route::post('/courseDetails','CourseController@CourseDetail');
Route::post('/CourseupdatateData','CourseController@CourseupdatateData');

// Admin Panel Courses manaement
Route::get('/Project','ProjectController@ProjectIndex');
Route::get('/getProjectData','ProjectController@getProjectData');
Route::post('/ProjectDetails','ProjectController@ProjectDetails');
Route::post('/ProjectDelete','ProjectController@ProjectDelete');
Route::post('/ProjectUpdate','ProjectController@ProjectUpdate');
Route::post('/addNewProject','ProjectController@addNewProject');