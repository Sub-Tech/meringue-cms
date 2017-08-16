<?php

namespace Plugins\SubTech\Staff;

use Illuminate\Support\Collection;

/**
 * Class StaffFormatter
 */
class StaffFormatter
{

    /**
     * Formats the staff into the correct order
     * Further formatting can be done in each individual method
     *
     * @param Collection $staff
     * @return Collection
     */
    public static function format(Collection $staff)
    {
        $formattedStaff = [];

        $formattedStaff['leadership'] = self::formatLeadership($staff['leadership']);

        $formattedStaff['bdm'] = self::formatBDMs($staff['bdm']);

        $formattedStaff['management'] = self::formatManagement($staff['management']);

        $formattedStaff['other'] = $staff['other'];

        return collect($formattedStaff);
    }


    /**
     * Formats the leadership
     *
     * @param $leadership
     * @return Collection
     */
    private static function formatLeadership($leadership)
    {
        return collect($leadership);
    }


    /**
     * Formats the BDMs
     *
     * @return Collection
     */
    private static function formatBDMs($bdms)
    {
        return collect($bdms);
    }


    /**
     * Formats the management
     *
     * @return Collection
     */
    private static function formatManagement($management)
    {
        return collect($management);
    }

}