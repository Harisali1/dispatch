<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], static function(){

    Route::get('create_route', 'RoutingController@index')->name('create.route');
    Route::get('routing', 'RoutingController@routing')->name('routing');


    Route::get('/clear-cache', function() {
        Artisan::call('optimize:clear');
        return "Caches cleared successfully!";
    });

});

