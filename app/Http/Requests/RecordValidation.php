<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordValidation extends FormRequest
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
            'date' => 'required',
            'time' => 'required',
            'measure' => 'required',
            'condition' => ['required', 'string', Rule::in(['1', '2'])]
        ];
    }
}
