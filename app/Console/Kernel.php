<?php

namespace App\Console;

use App\Schedulers\DatabaseUpdateSchedulers\Master\SuperAdminRegistrationVerificationCodes\DeleteExpiredSuperAdminRegistrationVerificationCodes as DeleteExpiredMasterSuperAdminRegistrationVerificationCodes;
use App\Schedulers\DatabaseUpdateSchedulers\Tenant\SuperAdminRegistrationVerificationCodes\DeleteExpiredSuperAdminRegistrationVerificationCodes as DeleteExpiredTenantSuperAdminRegistrationVerificationCodes;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(resolve(DeleteExpiredMasterSuperAdminRegistrationVerificationCodes::class))->everyMinute();
        $schedule->call(resolve(DeleteExpiredTenantSuperAdminRegistrationVerificationCodes::class))->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
