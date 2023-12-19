<?php

namespace App\Http\Traits;

use Illuminate\Validation\ValidationException;

trait FlattenErrors
{
    /**
     * Customize Laravel form request error.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return void
     */
    public function customFailedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response(['message' => $validator->errors()->first()], 422);
        throw new ValidationException($validator, $response);
    }
}
