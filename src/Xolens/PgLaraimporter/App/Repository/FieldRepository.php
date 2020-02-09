<?php

namespace Xolens\PgLaraimporter\App\Repository;

use Xolens\PgLaraimporter\App\Model\Field;
use Xolens\PgLarautil\App\Repository\AbstractWritableRepository;
use Illuminate\Validation\Rule;
use PgLaraimporterCreateTableField;

class FieldRepository extends AbstractWritableRepository implements FieldRepositoryContract
{
    public function model(){
        return Field::class;
    }
    /*
    public function validationRules(array $data){
        $id = self::get($data,'id');
        return [
            'id' => ['required',Rule::unique(PgLaraimporterCreateTableField::table())->where(function ($query) use($id) {
                return $query->where('id','!=', $id);
            })],
            'name' => [Rule::unique(PgLaraimporterCreateTableField::table())->where(function ($query) use($id) {
                return $query->where('id','!=', $id);
            })],
        ];
    }
    //*/
    
}
