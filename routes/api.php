<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('admin/users','UsersController');

// Department API Routes
Route::get('setup/departments/{keyword?}', 'DepartmentsController@index');  // List Departments
Route::post('setup/departments', 'DepartmentsController@store');            // Add Departments
Route::put('setup/departments', 'DepartmentsController@store');             // Update Departments
Route::delete('setup/departments/{id}', 'DepartmentsController@destroy');   // Delete Departments

// Site API Routes
Route::get('setup/sites/{keyword?}', 'SitesController@index');  // List Sites
Route::post('setup/sites', 'SitesController@store');            // Add Sites
Route::put('setup/sites', 'SitesController@store');             // Update Sites
Route::delete('setup/sites/{id}', 'SitesController@destroy');   // Delete Sites
Route::get('list/sites/parent', 'SitesController@parentSites');   // List Parent Sites