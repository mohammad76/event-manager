<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailOrMobile implements Rule
{
    /**
     * Create a new rule instance.
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (preg_match("/(0)[0-9]{10}/", $value) or filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return TRUE;
        }
    }

    /**
     * Get the validation error message.
     * @return string
     */
    public function message()
    {
        return 'The :attribute Should Valid Phone Number or Email.';
    }
}
