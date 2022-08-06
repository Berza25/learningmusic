<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NullableIf implements Rule
{
    private $otherField;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($otherField)
    {
        $this->otherField = $otherField;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->otherField === null)
        {
            return $value !== null;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Salah Satu Field Subject Matter atau Video Tidak Boleh Kosong.';
    }
}
