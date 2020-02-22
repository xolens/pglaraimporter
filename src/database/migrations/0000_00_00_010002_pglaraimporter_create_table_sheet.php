<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

use Xolens\PgLaraimporter\App\Util\PgLaraimporterMigration;

class PgLaraimporterCreateTableSheet extends PgLaraimporterMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'sheet';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::table(), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('import_id')->index();
            $table->string('name');
            $table->integer('record_count');
        });
        if(self::logEnabled()){
            self::registerForLog();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(self::logEnabled()){
            self::unregisterFromLog();
        }
        Schema::dropIfExists(self::table());

    }
}
