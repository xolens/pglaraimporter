<?php

namespace Xolens\PgLaraimporter\App\Util;

use Illuminate\Support\Facades\DB;

abstract class PgLaraimporterMigration extends AbstractPgLaraimporterMigration
{
    public static function tablePrefix(){
        return config('xolens-pglaraimporter.pglaraimporter-database_table_prefix');
    }

    public static function triggerPrefix(){
        return config('xolens-pglaraimporter.pglaraimporter-database_trigger_prefix');
    }

    public static function logEnabled(){
        return config('xolens-pglaraimporter.pglaraimporter-enable_database_log');
    }
}
