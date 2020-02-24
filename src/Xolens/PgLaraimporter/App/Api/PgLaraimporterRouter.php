<?php

namespace Xolens\PgLaraimporter\App\Api;

use Route;

class PgLaraimporterRouter
{  
    public static function get(){
        return function(){
            Route::get('{subroute}/index','\Xolens\PgLaraimporter\App\Api\Controller\GetController@paginate');
            Route::get('{subroute}/single/{id}','\Xolens\PgLaraimporter\App\Api\Controller\GetController@get');

            Route::get('import/{id}/sheet/index','\Xolens\PgLaraimporter\App\Api\Controller\GetByController@importBy');
            Route::get('sheet/{id}/record/index','\Xolens\PgLaraimporter\App\Api\Controller\GetByController@sheetBy');

            Route::post('import/index','\Xolens\PgLaraimporter\App\Api\Controller\ImportController@import');
            Route::post('import/delete','\Xolens\PgLaraimporter\App\Api\Controller\ImportController@deleteImport');
            Route::post('sheet/delete','\Xolens\PgLaraimporter\App\Api\Controller\ImportController@deleteSheet');
            Route::post('record/delete','\Xolens\PgLaraimporter\App\Api\Controller\ImportController@deleteRecord');

            Route::post('record/single','\Xolens\PgLaraimporter\App\Api\Controller\ImportController@updateRecord');
            //*/
        };
    }
}
