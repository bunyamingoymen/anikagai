<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FreshMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:fresh-all {--seed}';
    protected $description = 'Drop all tables and re-run all migrations for both default and shop databases';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Dropping all tables in the default database...');
        $this->dropAllTables(config('database.default'));

        $this->info('Dropping all tables in the shop database...');
        $this->dropAllTables('shop_mysql');

        $this->info('Running migrations...');
        Artisan::call('migrate', ['--force' => true]);

        if ($this->option('seed')) {
            $this->info('Seeding the databases...');
            Artisan::call('db:seed', ['--force' => true]);
        }

        $this->info('All done!');
    }

    private function dropAllTables($connection)
    {
        $tables = DB::connection($connection)->select('SHOW TABLES');

        Schema::connection($connection)->disableForeignKeyConstraints();

        foreach ($tables as $table) {
            $tableName = array_values((array)$table)[0];
            Schema::connection($connection)->drop($tableName);
        }

        Schema::connection($connection)->enableForeignKeyConstraints();
    }
}
