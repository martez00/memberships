<?php

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/403', 'HomeController@forbidden')->name('forbidden');

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'isAdmin'], function () {
        Route::get('/dashboard', 'HomeController@admin')->name('admin.dashboard');
        Route::resource('memberships_types', 'MembershipTypeController', [
            'names' => [
                'index' => 'memberships_types.index',
                'edit' => 'memberships_types.edit',
                'create' => 'memberships_types.create',
                'show' => 'memberships_types.show',
                'store' => 'memberships_types.store',
                'update' => 'memberships_types.update',
                'destroy' => 'memberships_types.destroy',
            ]]);
        Route::resource('memberships', 'MembershipController', [
            'names' => [
                'index' => 'memberships.index',
                'edit' => 'memberships.edit',
                'create' => 'memberships.create',
                'show' => 'memberships.show',
                'store' => 'memberships.store',
                'update' => 'memberships.update',
                'destroy' => 'memberships.destroy',
            ]]);
        Route::get('/users_memberships', 'UserMembershipController@index')->name('users_memberships.index');
    });
});

Route::get('/memberships', 'MembershipController@mainIndex')->name('memberships.mainIndex');
Route::get('/memberships/{id}', 'MembershipController@mainShow')->name('memberships.mainShow');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/user/dashboard', 'HomeController@user')->name('user.dashboard');
    Route::get('/user_memberships/{id}', 'UserMembershipController@userMemberships')->name('user.memberships');
    Route::get('/memberships/{id}/subscribe', 'MembershipController@showSubscribe')->name('memberships.showSubscribe');
    Route::post('/memberships/{id}/subscribe', 'StripePaymentController@stripePost')->name('stripe.post');
});

Route::get('/user_memberships/extend/{token}', 'UserMembershipController@showExtend')->name('user_membership.showExtend');
Route::post('/user_memberships/extend', 'UserMembershipController@extend')->name('user_membership.extend');
