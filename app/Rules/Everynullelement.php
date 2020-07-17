<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Everynullelement implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $values)
    {
         $var = false;
         foreach ($values as $value) {
             if($value != null)
             {
                $var = true;
             }
         }
         return $var;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please select attribute and values.';
    }
}
