<?php

namespace Plugins\SubTech\Staff\Commands;

use Illuminate\Console\Command;
use Plugins\SubTech\Staff\Libraries\Stamp;
use Plugins\SubTech\Staff\StampUser;

/**
 * Class RefreshStampUsers
 * @package Plugins\SubTech\Staff\Commands
 */
class RefreshStampUsers extends Command
{

    /**
     * The Command to be run
     *
     * @var string
     */
    protected $signature = 'staff:refresh';


    /**
     * The little description for 'php artisan'
     *
     * @var string
     */
    protected $description = 'Update the staff';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $stamp = new Stamp();
        $stamp->getUsers()->each(function (\stdClass $user) {
            StampUser::firstOrCreate([
                'userid' => $user->userid
            ], (array)$user)->save();
        });
    }

}
