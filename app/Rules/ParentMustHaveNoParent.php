<?php

namespace App\Rules;

use App\MenuOption;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class ParentMustHaveNoParent
 * @package App\Rules
 */
class ParentMustHaveNoParent implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return MenuOption::findOrFail($value)->parent_id == null;
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The specified parent is a parent itself';
    }

}
