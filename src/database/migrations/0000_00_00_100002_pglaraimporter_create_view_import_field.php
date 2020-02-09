<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaraimporter\App\Util\PgLaraimporterMigration;

class PgLaraimporterCreateViewImportField extends PgLaraimporterMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'import_field_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaraimporterCreateTableImportField::table();
        $fieldTable = PgLaraimporterCreateTableField::table();
        $importTable = PgLaraimporterCreateTableImport::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    ".$fieldTable.".name as field_name,
                    ".$importTable.".name as import_name
                FROM ".$mainTable." 
                    LEFT JOIN ".$fieldTable." ON ".$fieldTable.".id = ".$mainTable.".field_id
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

