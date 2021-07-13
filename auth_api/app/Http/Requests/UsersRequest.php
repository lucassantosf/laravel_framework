<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'role_id' => 'required',
            'password' => 'required|confirmed'
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
            'role_id.required' => 'Escolha o tipo do usuário',
            'password.required' => 'Senha obrigatória',
            'password.confirmed' => 'A senha e confirmação de senha não coincidem'
        ];
    }
}