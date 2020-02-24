<?php

namespace Xolens\PgLaraimporter\App\Api\Controller;

use Illuminate\Http\Request;
use Xolens\PgLarautil\App\Api\Controller\BaseController;


use Xolens\PgLaraimporter\App\Repository\View\ImportViewRepository;
use Xolens\PgLaraimporter\App\Repository\View\RecordViewRepository;
use Xolens\PgLaraimporter\App\Repository\View\SheetViewRepository;
use Xolens\PgLarautil\App\Util\Model\Sorter;

class GetByController extends BaseController
{

    public function importBy(Request $request, $id, SheetViewRepository $sheetViewRepository){
        $id = (int)$id;
        $page = $request->input('page');
        $limit = $request->input('limit');
        $sorter = self::inflateSorter($request);
        $filterer = self::inflateFilterer($request);
        return self::jsonResponse($sheetViewRepository->paginateByImportSortedFiltered($id, $sorter, $filterer, $limit, $page));
    }

    public function sheetBy(Request $request, $id, RecordViewRepository $recordViewRepository){
        $id = (int)$id;
        $page = $request->input('page');
        $limit = $request->input('limit');
        $sorter = self::inflateJsonSorter($request);
        $filterer = self::inflateFilterer($request);
        return self::jsonResponse($recordViewRepository->paginateBySheetSortedFiltered($id, $sorter, $filterer, $limit, $page));
    }

    protected static function inflateJsonSorter(Request $request){
        $sortArray = json_decode($request->input('sort'), true);
        if($sortArray==null){
            $sortArray = [['property'=>'id','direction'=>'DESC']];
        }
        foreach ($sortArray as $key => $value){
            if (strpos($value["property"], 'col') === 0) {
                $sortArray[$key]["property"] = "data->".$value["property"];
             }
        }
        $sorter = new Sorter($sortArray);
        return $sorter;
    }
}
