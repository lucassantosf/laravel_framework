<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagesRequest extends FormRequest
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
            'title' => 'required',
            'name' => 'required',
            'content' => 'required'
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
            'title.required' => 'Título obrigatório',
            'name.required' => 'Digite o nome da página',
            'content.required' => 'Digite o conteúdo da página'
        ];
    }
}