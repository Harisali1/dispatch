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

use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

// Auth::routes();

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/', 'HomeController@index');
Route::group(['middleware' => 'backendAuthenticate'], function () {
    //Dashboard
    Route::get('dashboard', 'UserController@signUpSuccess')->name('signup-success-get');
    //Profile
    Route::get('edit-profile', 'UserController@updateProfileView')->name('edit-profile');
    Route::post('edit-profile/update', 'UserController@updateEditProfile')->name('edit-profile.update');
    //Password Reset
    /*Route::get('reset-password', 'UserController@resetPasswordView')->name('reset-password.index');
    Route::put('change-password', 'UsersController@processChangePassword')->name('reset-password.update');*/
    Route::get('/change-password', ['uses' => 'UserController@resetPasswordView', 'as' => 'users.change-password']);
    Route::post('/change-password', ['uses' => 'UserController@processChangePassword', 'as' => 'users.change-password']);

    Route::group(['middleware' => ['backendAuthenticate', 'PermissionHandler']], function () {
        //Roles
        Route::resource('role', 'RoleController');
        Route::get('role/set-permissions/{role}', 'RoleController@setPermissions')->name('role.set-permissions');
        Route::post('role/set-permissions/update/{role}', 'RoleController@setPermissionsUpdate')->name('role.set-permissions.update');

        //Sub-Admin Route
        Route::resource('sub-admin', 'SubAdminController');
        Route::get('sub-admin/active/{record}', 'SubAdminController@active')->name('sub-admin.active');
        Route::get('sub-admin/inactive/{record}', 'SubAdminController@inactive')->name('sub-admin.inactive');

        //Dispatch Route
        Route::get('grocery-dispatch/data', 'DispatchController@groceryData')->name('Grocery-Dispatch.data');
        Route::get('grocery-dispatch', 'DispatchController@groceryIndex')->name('Grocery-Dispatch');
        Route::get('e-commerce-dispatch', 'DispatchController@eCommerceIndex')->name('E-Commerce-Dispatch');
        Route::get('dispatch-map', 'DispatchController@dispatchMap')->name('Dispatch-map');

        //Order Control
//        Route::get('order_control', 'ControlOrderController@index')->name('order.control.index');

        Route::resource('delivery_type', 'DeliveryTypeController');
        Route::get('delivery_type/status/{deliveryType}', 'DeliveryTypeController@status')->name('delivery_type.status');

        Route::resource('delivery_preference', 'DeliveryPreferenceController');
        Route::get('delivery_preference/status/{deliveryPreference}', 'DeliveryPreferenceController@status')->name('delivery_preference.status');

        Route::resource('order_category', 'OrderCategoryController');
//        Route::resource('order_zone_routing', 'OrderZoneRoutingController');
//        Route::resource('order_category_zones', 'OrderCategoryZoneController');

        Route::resource('schedule', 'ScheduleController');
        Route::post('schedule/search', 'ScheduleController@searchSchedule')->name('schedule.search');

        Route::get('shift/publisher', 'ShiftPublisherController@index')->name('shift.publisher.index');
        Route::post('shift/publisher/search', 'ShiftPublisherController@search')->name('shift.publisher.search');
        Route::get('shift/publisher/display/{schedule}/joey_id/{joey}', 'ShiftPublisherController@status')->name('shift.publisher.display');
        Route::delete('shift/publisher/enabled_disabled_schedule', 'ShiftPublisherController@enabledDisabledSchedule')->name('shift.publisher.enabled.disabled');

        Route::get('jobs', 'JobController@index')->name('job.route');
        Route::get('jobs/{id}', 'JobController@jobRoutes')->name('job.routes');
        Route::get('joey_routes', 'JoeyRouteController@index')->name('joey.route.index');

    });
});

#privacy-policy
//Route::get('privacy-policy', 'CmsController@showPrivacyPolicyView')->name('privacy-policy');
//#terms condition
//Route::get('terms-conditions', 'CmsController@showTermsConditionsView')->name('terms-conditions');
//#faq
//Route::get('faq', 'CmsController@showFaqView')->name('faq');
//#contact-us
//Route::get('contact-us', 'CmsController@showContactUsView')->name('contact-us');
//Route::post('create/contact', 'CmsController@createContact')->name('create-contact');
//#about
//Route::get('about', 'CmsController@showAboutView')->name('about');


Route::get('signup', 'Auth\RegisterController@showSignUpView')->name('sign-up');
Route::post('register-joey', 'Auth\RegisterController@registerJoey')->name('register-joey');
//Route::post('create/profile', 'Auth\RegisterController@create')->name('create-profile');
//Route::post('signup', 'Auth\RegisterController@signupStepOne')->name('signup-step-one');

// Activate joey account after signup
Route::get('/account/active/{email}/{token}', 'Auth\RegisterController@accountActive')->name('account.active');
Route::get('account/active/success', 'Auth\RegisterController@accountActiveSuccess')->name('account.active.success');
###Login ###
Route::get('/login', ['uses' => 'Auth\LoginController@showLoginForm', 'as' => 'login']);
Route::post('/login-joey', ['uses' => 'Auth\LoginController@login', 'as' => 'login-joey']);
###Logout###
Route::any('/logout', ['uses' => 'Auth\LoginController@logout', 'as' => 'logout']);
###Reset Password###
Route::post('/password/email', 'Auth\ForgotPasswordController@send_reset_link_email')->name('password.email');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset_password_update')->name('reset.password.update');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('/password/reset/{email}/{token}/{role_id}', 'Auth\ResetPasswordController@reset_password_from_show')->name('password.reset');

