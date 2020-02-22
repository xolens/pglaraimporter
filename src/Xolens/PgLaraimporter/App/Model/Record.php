<?php

namespace Xolens\PgLaraimporter\App\Model;
use Illuminate\Database\Eloquent\Model;

use PgLaraimporterCreateTableRecord;


class Record extends Model
{
    public const IMPORT_PROPERTY = 'import_id';

    public $timestamps = false;

    protected $casts = [
        'data' => 'json',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'sheet_name', 'data', 'import_id', 'import_date', 'completed', 
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
