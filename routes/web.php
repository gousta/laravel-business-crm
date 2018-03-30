<?php

/**
 * Protected Routing.
 */
Route::group([
    'middleware' => ['auth'],
], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/stat', 'StatController@index')->name('stat.index');
    Route::get('/labor', 'LaborController@index')->name('labor.index');

    Route::resource('catalog', 'CatalogController');
    Route::resource('expense', 'ExpenseController');

    Route::post('/client/{id}/labor', 'ClientController@laborStore')->name('client.labor.store');
    Route::get('/client/{id}/labor/{lid}/edit', 'ClientController@laborEdit')->name('client.labor.edit');
    Route::post('/client/{id}/labor/{lid}', 'ClientController@laborUpdate')->name('client.labor.update');
    Route::get('/client/{id}/labor/{lid}', 'ClientController@laborDestroy')->name('client.labor.destroy');
    Route::resource('client', 'ClientController');
});

Route::group([
    'middleware' => [],
], function () {
    Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@login']);
    Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\LoginController@logout']);

    // Registration Routes...
    Route::get('register', ['as' => 'auth.register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('register', ['as' => 'auth.register', 'uses' => 'Auth\RegisterController@register']);

    // Password Reset Routes...
    Route::get('password/reset/{token?}', ['as' => 'auth.password.reset', 'uses' => 'Auth\ForgotPasswordController@showResetForm']);
    Route::post('password/email', ['as' => 'auth.password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\ForgotPasswordController@reset']);
});
