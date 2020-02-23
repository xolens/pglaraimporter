<?php

namespace Xolens\PgLaraimporter\App\Model;
use Illuminate\Database\Eloquent\Model;

use PgLaraimporterCreateTableSheet;


class Sheet extends Model
{
    public const IMPORT_PROPERTY = 'import_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'import_id', 'name', 'column_count', 'record_count', 
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaraimporterCreateTableSheet::table();
        parent::__construct($attributes);
    }

    public function import(){
        return $this->belongsTo('Import','import_id');
    } 
}
