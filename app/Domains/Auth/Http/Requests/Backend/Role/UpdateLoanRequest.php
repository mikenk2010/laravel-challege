<?php

namespace App\Domains\Auth\Http\Requests\Backend\Role;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateLoanRequest.
 */
class UpdateLoanRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'loan_id' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
