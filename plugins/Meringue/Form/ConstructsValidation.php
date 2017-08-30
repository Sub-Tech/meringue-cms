<?php

namespace Plugins\Meringue\Form;

use Illuminate\Http\{
    Request
};

/**
 * Trait ConstructsValidation
 */
trait ConstructsValidation
{

    /**
     * Returns the Laravel formatted validation string
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    private function constructRulesFrom(Request $request): ?string
    {
        $rules = [];

        foreach ($request->all() as $input => $value) {
            if ($this->inputIsNotRelevant($input)) {
                continue;
            }

            $this->parse($input);

            if ($this->validationRuleRequiresValue($input)) {
                $rules[] = "{$input}:{$value}";
                continue;
            }

            $rules[] = $input;
        }

        return implode($glue = '|', $rules);
    }


    /**
     * Checks to see if the input validation rule requires a value
     *
     * @param string $input
     * @return bool
     */
    private function validationRuleRequiresValue(string $input)
    {
        return in_array($input, $requireValue = [
            'same'
        ]);
    }


    /**
     * Ignore any passed inputs not relevant to constructing validation
     *
     * @param string $input
     * @return bool
     */
    private function inputIsNotRelevant(string $input)
    {
        return str_contains($input, 'validation_');
    }


    /**
     * Remove validation_ from the input name
     *
     * @param string $input
     */
    private function parse(string &$input)
    {
        str_replace('validation_', '', $input);
    }

}