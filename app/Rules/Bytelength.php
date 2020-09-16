<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Bytelength implements Rule
{
    protected $byteCnt;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($byteCnt)
    {
        $this->byteCnt = $byteCnt;
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
        return strlen($value) < $this->byteCnt;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attributeは、'.$this->byteCnt.'バイト以下で入力してください';
    }
}
