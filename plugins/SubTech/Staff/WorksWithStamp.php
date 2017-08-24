<?php

namespace Plugins\SubTech\Staff;

use Illuminate\Support\Collection;

/**
 * Trait WorksWithStamp
 * @package Plugins\SubTech\Staff
 */
trait WorksWithStamp
{

    /**
     * Checks for inactive employees and deletes any if found
     *
     * @param Collection $users
     */
    private function checkForInactiveEmployees(Collection $users)
    {
        $stampUsers = StampUser::all();

        if ($this->thereAreInactiveEmployeesStillInTheDb($users, $stampUsers)) {
            $this->deleteInactiveEmployees($users, $stampUsers);
        }
    }


    /**
     * Will delete any Users in the db that weren't in the STAMP API call
     *
     * @param Collection $users
     * @param Collection $savedStampUsers
     * @return bool
     */
    private function thereAreInactiveEmployeesStillInTheDb(Collection $users, Collection $savedStampUsers): bool
    {
        return $users->count() != $savedStampUsers->count();
    }


    /**
     * Gathers Collections of saved employees and current employees
     * and 'destroys' any that aren't in both. Brutal.
     *
     * @param Collection $currentEmployees
     * @param Collection $savedStampUsers
     */
    private function deleteInactiveEmployees(Collection $currentEmployees, Collection $savedStampUsers)
    {
        $idsFromStamp = $currentEmployees->map(function ($user) {
            return $user->userid;
        });

        $idsInDb = $savedStampUsers->map(function ($savedUser) {
            return $savedUser->userid;
        });

        $idsInDb->diff($idsFromStamp)->each(function ($person) {
            StampUser::destroy($person);
        });
    }

}