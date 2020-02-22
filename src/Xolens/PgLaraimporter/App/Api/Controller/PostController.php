<?php

namespace Xolens\PgLaraimporter\App\Api\Controller;

use Illuminate\Http\Request;
use Xolens\PgLarautil\App\Api\Controller\BaseController;
use Validator;


use Xolens\PgLaraimporter\App\Repository\ImportRepository;
use Xolens\PgLaraimporter\App\Repository\RecordRepository;
use Xolens\PgLaraimporter\App\Repository\SheetRepository;

class PostController extends BaseController
{
    protected static $map;
    
    public static function map(){
        if(self::$map==null){
            self::$map =[
                'import' => ['repository' => new ImportRepository(),'ACTION' => ['STORE','UPDATE','DELETE'] ],
                'record' => ['repository' => new RecordRepository(),'ACTION' => ['STORE','UPDATE','DELETE'] ],
                'sheet' => ['repository' => new SheetRepository(),'ACTION' => ['STORE','UPDATE','DELETE'] ],
            ];
        }
        return self::$map;
    }

    public function create(Request $request, $subroute){
        if($this->has($subroute, self::ACTION_STORE)){
            $data = self::escapeData($request->except('id'));
            $validator = Validator::make(
                $data, 
                $this->repo($subroute)->validationRules($data),
                self::validationMessages($data, $subroute)
            );
    
            if ($validator->fails()) {
                $errors = $validator->errors();
                return self::jsonError($errors->all());
            }
            return self::jsonResponse($this->repo($subroute)->create($data));
        }
        return $this->notFound($subroute);
    }
    
    public function update(Request $request, $subroute){
        if($this->has($subroute, self::ACTION_UPDATE)){
            $id = $request->input('id');
            $data = self::escapeData($request->all());
            $validator = Validator::make(
                $data, 
                $this->repo($subroute)->validationRules($data),
                self::validationMessages($data, $subroute)
            );

            if ($validator->fails()) {
                $errors = $validator->errors();
                return self::jsonError($errors->all());
            }
            return self::jsonResponse($this->repo($subroute)->update($id, $data));
        }
        return $this->notFound($subroute);
    }
    
    public function delete(Request $request, $subroute){
        if($this->has($subroute, self::ACTION_UPDATE)){
            $identifiers = json_decode($request->input('identifiers'));
            return self::jsonResponse($this->repo($subroute)->delete($identifiers));
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
