<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    /**
     * Verifica se a validação é verdadeira ou falsa
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Array de campos obrigatórios do conteúdo
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'confirmed'
        ];
    }

    /**
     * Array de mensagens personalizadas dos campos obrigatórios
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Nome obrigatório',
            'email.required' => 'Digite o e-mail',
            'username.required' => 'Nome de usuário obrigatório',
            'password.confirmed' => 'A senha e confirmação de senha não coincidem'
        ];
    }
}