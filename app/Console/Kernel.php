<?php

namespace App\Console;

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
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $this->pluginCrons($schedule);
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

    public function pluginCrons(Schedule $schedule) {
        $plugins = Plugin::whereActive(1)->get();
        foreach($plugins as $plugin) {
            (new PluginBase())->initPlugin($plugin->class_name)->cron($schedule);
        }
    }



}
