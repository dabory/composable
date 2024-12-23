<?php

namespace App\Console;

use App\Console\Commands\DeleteDormantMemberCommand;
use App\Console\Commands\ResendEmailsCommand;
use App\Console\Commands\SendDormantTableCommand;
use App\Console\Commands\SendEmailsCommand;
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
        SendEmailsCommand::class,
        ResendEmailsCommand::class,
        SendDormantTableCommand::class,
        DeleteDormantMemberCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(SendEmailsCommand::class)->dailyAt('00:00');
        $schedule->command(ResendEmailsCommand::class)->dailyAt('00:30');
        $schedule->command(SendDormantTableCommand::class)->dailyAt('01:00');
        $schedule->command(DeleteDormantMemberCommand::class)->dailyAt('02:00');

//        $schedule->command(SendEmailsCommand::class)->everyFiveMinutes();
//        $schedule->command(ResendEmailsCommand::class)->everyFiveMinutes();
//        $schedule->command(SendDormantTableCommand::class)->everyFiveMinutes();
//        $schedule->command(DeleteDormantMemberCommand::class)->everyFiveMinutes();
    }

    protected function scheduleTimezone()
    {
        return 'Asia/Seoul';
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
