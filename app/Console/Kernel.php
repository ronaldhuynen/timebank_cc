<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // RTIPPIN MESSENGER SCHEDULER
        // PURGE WILL BE EXECUTED FOR ARCHIVED (SOFT-DELETED) DATA
        $schedule->command('messenger:calls:check-activity')->everyMinute();
        $schedule->command('messenger:invites:check-valid')->everyFifteenMinutes();
        $schedule->command('messenger:purge:threads --days=30')->dailyAt('1:00');
        $schedule->command('messenger:purge:messages --days=30')->dailyAt('2:00');
        $schedule->command('messenger:purge:images --days=30')->dailyAt('3:00');
        $schedule->command('messenger:purge:documents --days=365')->dailyAt('4:00');
        $schedule->command('messenger:purge:audio --days=30')->dailyAt('5:00');
        $schedule->command('messenger:purge:bots --days=30')->dailyAt('6:00');
        $schedule->command('messenger:purge:videos --days=30')->dailyAt('7:00');
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
