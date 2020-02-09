<?php

namespace Xolens\PgLaraimporter\App\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Route;

class PgLaraimporterRouter
{  
    public static function get(){
        return function(){
            Route::get('{subroute}/index','\Xolens\PgLaraimporter\App\Api\Controller\GetController@paginate');
            Route::get('{subroute}/single/{id}','\Xolens\PgLaraimporter\App\Api\Controller\GetController@get');

            Route::post('{subroute}/index','\Xolens\PgLaraimporter\App\Api\Controller\PostController@create');
            Route::post('{subroute}/single','\Xolens\PgLaraimporter\App\Api\Controller\PostController@update');
            Route::post('{subroute}/delete','\Xolens\PgLaraimporter\App\Api\Controller\PostController@delete');

            Route::get('field/{id}/{subroute}/index','\Xolens\PgLaraimporter\App\Api\Controller\GetByController@fieldBy');
            Route::get('import/{id}/{subroute}/index','\Xolens\PgLaraimporter\App\Api\Controller\GetByController@importBy');

            Route::post('{baseroure}/{id}/{subroute}/index', '\Xolens\PgLaraimporter\App\Api\Controller\PostByController@createBy');
            Route::post('{baseroure}/{id}/{subroute}/single', '\Xolens\PgLaraimporter\App\Api\Controller\PostByController@updateBy');
        };
    }
}
