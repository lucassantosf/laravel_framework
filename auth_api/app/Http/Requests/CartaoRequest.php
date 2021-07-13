<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartaoRequest extends FormRequest
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
            'number' => 'required',
            'holder_name' => 'required' , 
            'expiration_date' => 'required' ,
            'cvv' => 'required' ,
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
            'number.required' => 'Número do cartão obrigatório',
            'holder_name.required' => 'Nome do titular é obrigatório' , 
            'expiration_date.required' => 'Validade do cartão é obrigatório' , 
            'cvv.required' => 'Código de segurança do cartão é obrigatório',
        ];
    }
}
