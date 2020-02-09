<?php

namespace Xolens\PgLaraimporter\App\Repository;

use Xolens\PgLaraimporter\App\Model\Record;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaraimporterCreateTableRecord;

class RecordRepository extends AbstractWritableRepository implements RecordRepositoryContract
{
    public function model(){
        return Record::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        $importId = self::get($data,'import_id');
        return [
            'id' => ['required',Rule::unique(PgLaraimporterCreateTableRecord::table())->where(function ($query) use($id, $importId) {
                return $query->where('id','!=', $id)->where('import_id', $importId);
            })],
        ];
    }
    //*/
    
}
