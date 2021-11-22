<?php

namespace App\Domains\Auth\Http\Requests\Frontend\User;

use App\Domains\Auth\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreLoanTransactionRequest.
 */
class StoreLoanTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // @Todo validate here, do it later!
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
            'transaction_id' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        // @Todo Show message, but late leh!
        return [];
    }
}
