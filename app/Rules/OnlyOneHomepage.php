<?php

namespace App\Rules;

use App\Page;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class OnlyOneHomepage
 * @package App\Rules
 */
class OnlyOneHomepage implements Rule
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
        return !Page::whereHomepage(1)->exists();
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Homepage has already been defined';
    }

}
