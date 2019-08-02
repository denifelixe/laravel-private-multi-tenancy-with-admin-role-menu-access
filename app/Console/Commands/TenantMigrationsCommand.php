<?php

namespace App\Console\Commands;

use App\Exceptions\Tenant\NoTenantFoundException;
use App\Configurations\DatabaseConfiguration;
use App\Repositories\Master\Tenants\TenantsInterface;
use Illuminate\Console\Command;

class TenantMigrationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:tenant {subdomain} {--rollback}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Tenant\'s Database';

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
        try {
            
            DatabaseConfiguration::resetConnectionToTenantDatabase($this->argument('subdomain'));

        } catch (NoTenantFoundException $e) {
            
            $this->error('Tenant with subdomain "' . $this->argument('subdomain') . '" Not Found!');
            die;

        }

        if (!$this->option('rollback')) {

            $this->call('migrate', [
                '--path' => '/database/migrations/tenant'
            ]);

            $this->info('Tenant\'s database successfully migrated!');

        } else {

            $this->call('migrate:rollback', [
                '--path' => '/database/migrations/tenant'
            ]);

            $this->info('Tenant\'s database successfully rollbacked!');

        }


    }
}
