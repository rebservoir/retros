<?php

namespace TuFracc\Console;

use DB;
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
        \TuFracc\Console\Commands\Inspire::class,
        \TuFracc\Console\Commands\Test::class,
        \TuFracc\Console\Commands\limite::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly(); 
        
        //$schedule->command('tst:prueba')->everyMinute(); 
        $schedule->command('lmt:limite')->everyMinute(); 

    }
}
