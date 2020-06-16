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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('dashboard');

Route::group(['namespace'=>'Backend', 'middleware' => 'auth'], function(){
    Route::resource('/responsible', 'ResponsibleController');
    Route::resource('/university', 'UniversityController');
    Route::resource('/member', 'MemberController');
    Route::resource('/photo', 'PhototitleController');
    Route::resource('/category', 'CategoryController');
    Route::resource('/post', 'PostController');
    Route::resource('/activity', 'ActivityController');
    Route::get('/search-member', 'SearchController@searchMember');
    Route::get('/search-activity', 'SearchController@searchActivity');
    Route::get('/search-post', 'SearchController@searchPost');
    Route::get('/search-category', 'SearchController@searchCategory');
    Route::get('/search-photo', 'SearchController@searchPhoto');
});
