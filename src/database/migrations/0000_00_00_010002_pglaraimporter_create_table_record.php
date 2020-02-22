<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

use Xolens\PgLaraimporter\App\Util\PgLaraimporterMigration;

class PgLaraimporterCreateTableRecord extends PgLaraimporterMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'record';
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
            $table->string('sheet_name');
            $table->json('data');
            $table->integer('import_id')->index();
            $table->timestamp('import_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('completed')->default(0);
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
