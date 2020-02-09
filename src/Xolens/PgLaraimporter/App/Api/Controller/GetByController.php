<?php

namespace Xolens\PgLaraimporter\App\Api\Controller;

use Illuminate\Http\Request;
use Xolens\PgLarautil\App\Api\Controller\BaseController;


use Xolens\PgLaraimporter\App\Repository\View\FieldViewRepository;
use Xolens\PgLaraimporter\App\Repository\View\ImportViewRepository;
use Xolens\PgLaraimporter\App\Repository\View\ImportFieldViewRepository;
use Xolens\PgLaraimporter\App\Repository\View\RecordViewRepository;

class GetByController extends BaseController
{
    protected static $map;
    
    public static function map(){
        if(self::$map==null){
            self::$map =[
                'field' => ['repository' => new FieldViewRepository(),'ACTION' => ['PAGINATE','GET'] ],
                'import' => ['repository' => new ImportViewRepository(),'ACTION' => ['PAGINATE','GET'] ],
                'importfield' => ['repository' => new ImportFieldViewRepository(),'ACTION' => ['PAGINATE','GET'] ],
                'record' => ['repository' => new RecordViewRepository(),'ACTION' => ['PAGINATE','GET'] ],
            ];
        }
        return self::$map;
    }

    public function fieldBy(Request $request, $id, $subroute){
        $id = (int)$id;
        if($this->has($subroute, self::ACTION_PAGINATE)){
            $page = $request->input('page');
            $limit = $request->input('limit');
            $sorter = self::inflateSorter($request);
            $filterer = self::inflateFilterer($request);
            return self::jsonResponse($this->repo($subroute)->paginateByFieldSortedFiltered($id, $sorter, $filterer, $limit, $page));
        }
        return $this->notFound($subroute);
    }

    public function importBy(Request $request, $id, $subroute){
        $id = (int)$id;
        if($this->has($subroute, self::ACTION_PAGINATE)){
            $page = $request->input('page');
            $limit = $request->input('limit');
            $sorter = self::inflateSorter($request);
            $filterer = self::inflateFilterer($request);
            return self::jsonResponse($this->repo($subroute)->paginateByImportSortedFiltered($id, $sorter, $filterer, $limit, $page));
        }
        return $this->notFound($subroute);
    }

    protected function has($subroute, $action) {
        return self::hasAction(self::map(), $subroute, $action);
    }

    public function repo($subroute){
        return self::repository(self::map(), $subroute);
    }
}
