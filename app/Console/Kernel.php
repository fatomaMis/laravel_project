<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\MyCommandDemo::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('mycommand:demo')->everyMinute();
    }
}