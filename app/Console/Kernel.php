<?php

namespace App\Console;

use App\Console\Commands\sendReminderEmail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // Verify task every minute
        // $schedule->command(sendReminderEmail::class, ['Taylor', '--force'])->everyMinute();
        // $schedule->call(function () {
        //     \Illuminate\Support\Facades\Artisan::call('app:send-reminder-email');
        // })->everyMinute();
        $schedule->command('app:send-reminder-email')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
