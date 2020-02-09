<?php

namespace Xolens\PgLaraimporter\App\Model;
use Illuminate\Database\Eloquent\Model;

use PgLaraimporterCreateTableField;


class Field extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'type', 
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaraimporterCreateTableField::table();
        parent::__construct($attributes);
    }
}
