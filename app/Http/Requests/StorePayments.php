<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayments extends FormRequest
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
            'comp_code'         => 'required|not_in:0',
            'amount'            => 'required|numeric',
            'account_id'        => 'nullable',
            'vendor_id'         => 'nullable',
            'paid_at'           => 'nullable|date_format:Y-m-d',
            'narration'         => 'required',
            'exp_in_user'       => 'nullable',
            'exp_permit_user'   => 'nullable',
            'email'             => 'nullable|email',            
            'mode_id'           => 'required|not_in:0',
            'status'            => 'required',
            'catg_id'           => 'required',
            'req_approval'      => 'required',
            'note'              => 'nullable',     
        ];
    }
}
