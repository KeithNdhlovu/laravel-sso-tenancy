<?php

namespace App\Http\Requests\Admin;

use App\Http\Traits\FlattenErrors;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseAdminRequest extends FormRequest
{
    use FlattenErrors;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Customize Laravel form request error messages.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return void
     */
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->customFailedValidation($validator);
    }
}
