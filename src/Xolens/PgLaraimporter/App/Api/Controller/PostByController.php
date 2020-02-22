<?php

namespace Xolens\PgLaraimporter\App\Api\Controller;

use Illuminate\Http\Request;

class PostByController extends PostController
{
    public function createBy(Request $request, $baseroute, $id, $subroute){
        $keymap = $this->keyMap();
        if(array_key_exists($baseroute, $keymap)){
            $request->request->add([$keymap[$baseroute]=>$id]);
        }
        return parent::create($request, $subroute);
    }
    
    public function updateBy(Request $request, $baseroute, $id, $subroute){
        $keymap = $this->keyMap();
        if(array_key_exists($baseroute, $keymap)){
            $request->request->add([$keymap[$baseroute]=>$id]);
        }
        return parent::update($request, $subroute);
    }
    
    public function keyMap(){
        return [
            'import' => 'import_id',
            'record' => 'record_id',
            'sheet' => 'sheet_id',
        ];
    }
}
