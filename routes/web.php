<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('/catalog/{id}/delete', 'CatalogController@delete')->name('catalog.delete');

    Route::resource('expense', 'ExpenseController');
    Route::resource('vat', 'VatController');
    Route::resource('user', 'UserController');

    Route::get('/appointments', 'AppointmentController@index')->name('appointment.index');
    Route::get('/appointments2', 'AppointmentNextGenController@index')->name('appointmentNextGen.index');

    Route::get('/schedule', 'ScheduleController@index')->name('schedule.index');

    Route::resource('client', 'ClientController');
    Route::get('/client/{id}/delete', 'ClientController@delete')->name('client.delete');
    Route::post('/client/{id}/labor', 'ClientController@laborStore')->name('client.labor.store');
    Route::get('/client/{id}/labor/{laborId}/edit', 'ClientController@laborEdit')->name('client.labor.edit');
    Route::post('/client/{id}/labor/{laborId}', 'ClientController@laborUpdate')->name('client.labor.update');
    Route::get('/client/{id}/labor/{laborId}', 'ClientController@laborDestroy')->name('client.labor.destroy');

    // Async
    Route::get('/async/appointments', 'AppointmentController@asyncIndexAppointments')->name('async.appointment.index');
    Route::put('/async/appointments', 'AppointmentController@asyncUpdateAnyAppointment')->name('async.appointment.any.update');
    Route::put('/async/schedule-exclusions', 'ScheduleController@asyncUpdateScheduleExclusions')->name('async.scheduleExclusion.any.update');
    Route::post('/async/client/{id}/labor/{laborId}', 'ClientController@asyncLaborUpdate')->name('async.client.labor.update');
});

Route::group([
    'middleware' => [],
], function () {
    Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@login']);
    Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\LoginController@logout']);

    // Registration Routes...
    // Route::get('register', ['as' => 'auth.register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    // Route::post('register', ['as' => 'auth.register', 'uses' => 'Auth\RegisterController@register']);

    // Password Reset Routes...
    Route::get('password/reset/{token?}', ['as' => 'auth.password.reset', 'uses' => 'Auth\ForgotPasswordController@showResetForm']);
    Route::post('password/email', ['as' => 'auth.password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\ForgotPasswordController@reset']);


    Route::get('/manifest.json', function () {
        return response()->json([
            "name" => "CRM",
            "icons" => [
                [
                    "src" => "web_hi_res_512.png",
                    "sizes" => "36x36",
                    "type" => "image/png",
                    "density" => 0.75
                ],
                [
                    "src" => "web_hi_res_512.png",
                    "sizes" => "48x48",
                    "type" => "image/png",
                    "density" => 1
                ],
                [
                    "src" => "web_hi_res_512.png",
                    "sizes" => "72x72",
                    "type" => "image/png",
                    "density" => 1.5
                ],
                [
                    "src" => "web_hi_res_512.png",
                    "sizes" => "96x96",
                    "type" => "image/png",
                    "density" => 2
                ],
                [
                    "src" => "web_hi_res_512.png",
                    "sizes" => "144x144",
                    "type" => "image/png",
                    "density" => 3
                ],
                [
                    "src" => "web_hi_res_512.png",
                    "sizes" => "192x192",
                    "type" => "image/png",
                    "density" => 4
                ],
                [
                    "src" => "web_hi_res_512.png",
                    "sizes" => "512x512",
                    "type" => "image/png",
                    "density" => 4
                ]
            ],
            "start_url" => "/",
            "display" => "standalone",
            "background_color" => config('crm.color'),
            "description" => "CRM",
            "orientation" => "any"
        ]);
    });
});
