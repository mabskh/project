<?php


use Illuminate\Support\Facades\Route;


Route::group([ 'namespace' => 'Admin' , 'middleware' => 'auth:admin' ], function () {


    Route::get('/' , 'Dashboardcontroller@index') -> name('admin.dashboard');
    Route::get('/logout', 'LoginController@logout')->name('admin.logout');

    ### Begin Main Categories Routes
    route::group(['prefix' => 'profile'], function () {
        Route::get('edit', 'ProfileController@editProfile')->name('edit.profile');
        Route::put('update', 'ProfileController@updateProfile')->name('update.profile');
    });
    ### End Main Categories Routes



});


Route::group([ 'namespace' => 'Admin' , 'middleware' => 'guest:admin' ], function () {
    route::get('login','LoginController@getLogin')->name('get.admin.login');
    route::post('login','LoginController@login')->name('admin.login');
});
