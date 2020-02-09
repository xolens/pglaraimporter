<?php

namespace Xolens\PgLaraimporter\App\Model;
use Illuminate\Database\Eloquent\Model;

use PgLaraimporterCreateTableImportField;


class ImportField extends Model
{
    public const IMPORT_PROPERTY = 'import_id';
    public const FIELD_PROPERTY = 'field_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'import_id', 'field_id', 'position', 
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaraimporterCreateTableImportField::table();
        parent::__construct($attributes);
    }

    public function import(){
        return $this->belongsTo('Import','import_id');
    } 

    public function field(){
        return $this->belongsTo('Field','field_id');
    } 
}
