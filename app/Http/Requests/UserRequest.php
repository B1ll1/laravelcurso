<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            'name' => 'required|max:100|min:1',
            'photo' => 'image',
            'email' => 'required|max:100|min:1',
            'password' => 'required|max:30|min:1',
            'password_check' => 'required|max:30|min:1|same:password'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo obrigatório.',
            'image' => 'O arquivo deve ser uma imagem (jpg, png, bmp, gif, ...)',
            'max' => 'O nome não pode exceder :max caracteres.',
            'min' => 'O nome deve conter no mínimo :min caracteres.',
            'same'    => 'A senha e a confirmação de senha devem ser iguais'
        ];

    }
}
