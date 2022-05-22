<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
            {
                return[
                    'name'              => 'required|min:3|max:30',
                    'phone'             => 'required|numeric|digits:10',
                    'treatment_state'   => 'nullable',
                    'identity_number'   => 'required|numeric|unique:patients,identity_number',
                ];
            }
            case 'PUT':
            // {
            //     return[
            //         'name'              => 'required|min:3|max:30',
            //         'phone'             => 'required|numeric|digits:10',
            //         'treatment_state'   => 'nullable',
            //         'identity_number'   => '',
            //         // 'date'              => '',
            //     ];
            // }
                case 'PATCH':
            default: break;
        }
    }
}
