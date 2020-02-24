<?php
   
namespace Xolens\PgLaraimporter\App\Api\Controller;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Xolens\PgLaraimporter\App\Model\Import;
use Xolens\PgLaraimporter\App\Model\Record;
use Xolens\PgLaraimporter\App\Model\Sheet;

use Xolens\PgLarautil\App\Api\Controller\BaseController;

use Xolens\PgLaraimporter\App\Repository\ImportRepository;
use Xolens\PgLaraimporter\App\Repository\RecordRepository;
use Xolens\PgLaraimporter\App\Repository\SheetRepository;

use Validator;


class ImportController extends BaseController
{   
   
    public function import(Request $request, ImportRepository $importRepository){
        $name = $request->input('name');
        $description = $request->input('description');
        $file = Input::file('file');
        $import = $importRepository->importFile($name, $description, $file);
        return self::jsonResponse($import);

    }

    public function deleteImport(Request $request, ImportRepository $importRepository){
        $identifiers = json_decode($request->input('identifiers'));
        Record::whereIn('import_id', $identifiers)->delete();
        Sheet::whereIn('import_id', $identifiers)->delete();
        return self::jsonResponse($importRepository->delete($identifiers));
    }

    public function deleteSheet(Request $request, SheetRepository $sheetRepository){
        $identifiers = json_decode($request->input('identifiers'));
        Record::whereIn('import_id', $identifiers)->delete();
        return self::jsonResponse($sheetRepository->delete($identifiers));
    }

    public function deleteRecord(Request $request, RecordRepository $recordRepository){
        $identifiers = json_decode($request->input('identifiers'));
        return self::jsonResponse($recordRepository->delete($identifiers));
    }

    public function updateRecord(Request $request, ImportRepository $recordRepository){
        $id = $request->input('id');
        $data = self::escapeData($request->all());
        $validator = Validator::make(
            $data, 
            $recordRepository->validationRules($data)
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return self::jsonError($errors->all());
        }
        return self::jsonResponse($recordRepository->update($id, $data));
    }
}