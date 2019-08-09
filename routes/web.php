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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/403', 'HomeController@forbidden')->name('forbidden');

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'isAdmin'], function () {
        Route::get('/dashboard', 'HomeController@admin')->name('admin.dashboard');
        Route::resource('memberships_types', 'MembershipsTypesController', [
            'names' => [
                'index' => 'memberships_types.index',
                'edit' => 'memberships_types.edit',
                'create' => 'memberships_types.create',
            ]]);
    });
});