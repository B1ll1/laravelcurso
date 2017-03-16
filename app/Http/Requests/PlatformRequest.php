<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PlatformRequest extends Request
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
            'name' => 'required|min:2|max:100',
            'url'  => 'required|min:3|max:50'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Campo obrigatório.',
            'name.min'      => 'Mínimo de caracteres :min.',
            'name.max'      => 'Máximo de caracteres :max.',
            'url.required'  => 'Campo obrigatório.',
            'url.min'       => 'Mínimo de caracteres :min.',
            'url.max'       => 'Máximo de caracteres :max.',
        ];
    }
}
