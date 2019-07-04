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
Route::get('setup/departments/{keyword?}', 'Setup\DepartmentsController@index');  // List Departments
Route::post('setup/departments', 'Setup\DepartmentsController@store');            // Add Departments
Route::put('setup/departments', 'Setup\DepartmentsController@store');             // Update Departments
Route::delete('setup/departments/{id}', 'Setup\DepartmentsController@destroy');   // Delete Departments

// Site API Routes
Route::get('setup/sites/{keyword?}', 'Setup\SitesController@index');  // List Sites
Route::post('setup/sites', 'Setup\SitesController@store');            // Add Sites
Route::put('setup/sites', 'Setup\SitesController@store');             // Update Sites
Route::delete('setup/sites/{id}', 'Setup\SitesController@destroy');   // Delete Sites
Route::get('list/sites/parent', 'Setup\SitesController@parentSites');   // List Parent Sites

// Asset Types API Routes
Route::get('setup/assettypes/{keyword?}', 'Setup\AssetTypesController@index');  // List Asset Types
Route::post('setup/assettypes', 'Setup\AssetTypesController@store');            // Add Asset Types
Route::put('setup/assettypes', 'Setup\AssetTypesController@store');             // Update Asset Types
Route::delete('setup/assettypes/{id}', 'Setup\AssetTypesController@destroy');   // Delete Asset Types

// Property Types API Routes
Route::get('setup/proptypes/{keyword?}', 'Setup\PropertyTypesController@index');  // List Property Types
Route::post('setup/proptypes', 'Setup\PropertyTypesController@store');            // Add Property Types
Route::put('setup/proptypes', 'Setup\PropertyTypesController@store');             // Update Property Types
Route::delete('setup/proptypes/{id}', 'Setup\PropertyTypesController@destroy');   // Delete Property Types