<?php

namespace Xolens\PgLaraimporter\App\Repository;

use Xolens\PgLaraimporter\App\Model\ImportField;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaraimporterCreateTableImportField;

class ImportFieldRepository extends AbstractWritableRepository implements ImportFieldRepositoryContract
{
    public function model(){
        return ImportField::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $importId = self::get($data,'import_id');
        $fieldId = self::get($data,'field_id');
        return [
            'id' => ['required',Rule::unique(PgLaraimporterCreateTableImportField::table())->where(function ($query) use($id, $importId, $fieldId) {
                return $query->where('id','!=', $id)->where('import_id', $importId)->where('field_id', $fieldId);
            })],
        ];
    }
    //*/
    
}
