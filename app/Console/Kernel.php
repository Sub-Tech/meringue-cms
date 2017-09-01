<?php

namespace App\Console;

use App\Helpers\PluginInitialiser;
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
            $pluginClass = PluginInitialiser::getPlugin($plugin->class_name);

            if ($this->pluginImplementsCronInterface($pluginClass)) {
                $pluginClass->schedule($schedule);
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


    /**
     * Check to see if the Plugin implements the CronInterface ergo has a Cron
     *
     * @param PluginBase $plugin
     * @return bool
     */
    private function pluginImplementsCronInterface(PluginBase $plugin)
    {
        return in_array('App\CronInterface', class_implements($plugin));
    }

}
