<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Cleanse database and S3 bucket for old messages
     *
     * @var array
     */
    protected $commands = [
        Commands\HourlyUpdate::class
    ];
    
    /**
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('hour:update')
        ->everyMinute();
                
    }

    /**
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
