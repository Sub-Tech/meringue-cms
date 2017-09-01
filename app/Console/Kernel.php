<?php

namespace App\Console;

use App\CronInterface;
use App\Plugin\PluginInitialiser;
use App\Plugin;
use App\PluginBase;
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

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        Plugin::whereActive(1)->get()->each(function (Plugin $plugin) use (&$schedule) {
            $plugin = PluginInitialiser::getPlugin($plugin->class_name);

            if ($plugin->implements(CronInterface::class)) {
                $plugin->schedule($schedule);
            }
        });
    }


    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }

}
