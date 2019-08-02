<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MasterMigrationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:master {--rollback}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Master\'s Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        if (!$this->option('rollback')) {

            $this->call('migrate', [
                '--path' => '/database/migrations/master'
            ]);

            $this->info('Master\'s database successfully migrated!');

        } else {

            $this->call('migrate:rollback', [
                '--path' => '/database/migrations/master'
            ]);

            $this->info('Master\'s database successfully rollbacked!');

        }
    }
}
