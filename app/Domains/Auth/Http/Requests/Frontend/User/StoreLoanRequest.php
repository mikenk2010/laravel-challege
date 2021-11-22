<?php

namespace App\Domains\Auth\Http\Requests\Frontend\User;

use App\Domains\Auth\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreLoanRequest.
 */
class StoreLoanRequest extends FormRequest
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
            'amount' => ['required', 'numeric'],
            'term' => ['required', 'numeric'],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        // Show message, but late leh!
        return [
            'amount.*' => __('Loan amount must be a number'),
        ];
    }
}
