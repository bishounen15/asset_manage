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

Route::group(['middleware'=>['web','auth','revalidate']], function() {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/admin/users',function() {
        return view('admin.users.index');
    });

    Route::get('/setup/departments',function() {
        return view('setup.dept.index');
    });

    Route::get('/setup/sites',function() {
        return view('setup.site.index');
    });

    Route::get('/setup/assettypes',function() {
        return view('setup.assettype.index');
    });

    Route::get('/setup/proptypes',function() {
        return view('setup.proptype.index');
    });

    Route::get('/setup/assetstatus',function() {
        return view('setup.assetstatus.index');
    });

    Route::get('/assets',function() {
        return view('assets.index');
    });

    Route::get('/assets/profile/{id?}','Asset\RecordsController@profile');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
