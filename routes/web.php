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


Route::get('auth/sms', 'Auth\AuthController@getSms')->name('sms');
Route::post('auth/sms', 'Auth\AuthController@postSms');
Route::post('auth/verify', 'Auth\AuthController@postVerify');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


Route::group(['middleware' => 'DashboardAuthenticate', 'namespace' => 'Admin'], function () {

    //dashboard
    Route::get('/', 'DashboardController@welCome');

    // User roles
    Route::resource('user/roles', 'RolesController');
    Route::resource('user/permissions', 'PermissionsController');

    //group features Routs
    Route::post('group_features/getFeatures', 'GroupFeaturesController@getFeatures');
    Route::resource('group_features', 'GroupFeaturesController');

    //features Routs
    Route::resource('features/{features_id}/answers', 'FeaturesQuestionsAnswersController');
    Route::resource('features', 'FeaturesController');

    //Category
    Route::resource('category', 'CategoryController');


});