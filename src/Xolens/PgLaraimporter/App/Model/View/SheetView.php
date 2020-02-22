<?php

namespace Xolens\PgLaraimporter\App\Model\View;
use Illuminate\Database\Eloquent\Model;

use PgLaraimporterCreateViewSheet;



class SheetView extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;
    
    function __construct(array $attributes = []) {
        $this->table = PgLaraimporterCreateViewSheet::table();
        parent::__construct($attributes);
    }
}

