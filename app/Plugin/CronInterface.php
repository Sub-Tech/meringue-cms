<?php

namespace App\Plugin;

use Illuminate\Console\Scheduling\Schedule;

/**
 * Interface PluginInterface
 * To be implemented when a Plugin can have unique instances
 * Forms, Text Blocks for Example. Not STAMP coz that's static
 *
 * @package App
 */
interface CronInterface
{

    /**
     * A list of all crons to be run. Follows the same format as Laravel Scheduled Tasks.
     *
     * @param Schedule $schedule
     */
    public function schedule(Schedule $schedule);

}