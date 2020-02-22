<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaraimporter\App\Util\PgLaraimporterMigration;

class PgLaraimporterCreateViewSheet extends PgLaraimporterMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'sheet_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaraimporterCreateTableSheet::table();
        $importTable = PgLaraimporterCreateTableImport::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    ".$importTable.".name as import_name
                FROM ".$mainTable." 
                    LEFT JOIN ".$importTable." ON ".$importTable.".id = ".$mainTable.".import_id
            )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS ".self::table());
    }
}

