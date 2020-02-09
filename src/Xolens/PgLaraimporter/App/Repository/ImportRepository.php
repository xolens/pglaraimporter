<?php

namespace Xolens\PgLaraimporter\App\Repository;

use Xolens\PgLaraimporter\App\Model\Import;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaraimporterCreateTableImport;

class ImportRepository extends AbstractWritableRepository implements ImportRepositoryContract
{
    public function model(){
        return Import::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        return [
            'id' => ['required',Rule::unique(PgLaraimporterCreateTableImport::table())->where(function ($query) use($id) {
                return $query->where('id','!=', $id);
            })],
            'name' => [Rule::unique(PgLaraimporterCreateTableImport::table())->where(function ($query) use($id) {
                return $query->where('id','!=', $id);
            })],
        ];
    }
    //*/
    
}
