<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

use Xolens\PgLaraimporter\App\Util\PgLaraimporterMigration;

class PgLaraimporterCreateTableImport extends PgLaraimporterMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'import';
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
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('record_count');
            $table->integer('sheet_count');
            $table->enum('state',['STARTED', 'UPLOADED', 'COMPLETED', 'PARTIAL'])->default('STARTED');
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
