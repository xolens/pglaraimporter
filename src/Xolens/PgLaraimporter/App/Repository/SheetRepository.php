<?php

namespace Xolens\PgLaraimporter\App\Repository;

use Xolens\PgLaraimporter\App\Model\Sheet;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaraimporterCreateTableSheet;

class SheetRepository extends AbstractWritableRepository implements SheetRepositoryContract
{
    public function model(){
        return Sheet::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $importId = self::get($data,'import_id');
        return [
            'id' => ['required',Rule::unique(PgLaraimporterCreateTableSheet::table())->where(function ($query) use($id, $importId) {
                return $query->where('id','!=', $id)->where('import_id', $importId);
            })],
        ];
    }
    //*/
    
}
