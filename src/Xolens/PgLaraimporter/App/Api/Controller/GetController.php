<?php

namespace Xolens\PgLaraimporter\App\Api\Controller;

use Illuminate\Http\Request;
use Xolens\PgLarautil\App\Api\Controller\BaseController;


use Xolens\PgLaraimporter\App\Repository\View\ImportViewRepository;
use Xolens\PgLaraimporter\App\Repository\View\RecordViewRepository;
use Xolens\PgLaraimporter\App\Repository\View\SheetViewRepository;

class GetController extends BaseController
{
    protected static $map;
    
    public static function map(){
        if(self::$map==null){
            self::$map =[
                'import' => ['repository' => new ImportViewRepository(),'ACTION' => ['PAGINATE','GET'] ],
                'record' => ['repository' => new RecordViewRepository(),'ACTION' => ['PAGINATE','GET'] ],
                'sheet' => ['repository' => new SheetViewRepository(),'ACTION' => ['PAGINATE','GET'] ],
            ];
        }
        return self::$map;
    }

    public function paginate(Request $request, $subroute){
        if($this->has($subroute, self::ACTION_PAGINATE)){
            $page = $request->input('page');
            $limit = $request->input('limit');
            $sorter = self::inflateSorter($request);
            $filterer = self::inflateFilterer($request);
            return self::jsonResponse($this->repo($subroute)->paginateSortedFiltered($sorter, $filterer, $limit, $page));
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
