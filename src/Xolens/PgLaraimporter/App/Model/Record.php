<?php

namespace Xolens\PgLaraimporter\App\Model;
use Illuminate\Database\Eloquent\Model;

use PgLaraimporterCreateTableRecord;


class Record extends Model
{
    public const IMPORT_PROPERTY = 'import_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'data', 'import_id', 'import_date', 'validation_date', 'raw_data', 
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaraimporterCreateTableRecord::table();
        parent::__construct($attributes);
    }

    public function import(){
        return $this->belongsTo('Import','import_id');
    } 
}
