<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlidesRequest extends FormRequest
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
            'image' => 'required',
            'title' => 'required',
            'button' => 'required',
            'url' => 'required',
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
            'image.required' => 'Imagem obrigatória',
            'title.required' => 'Título obrigatório',
            'button.required' => 'Informe o texto do botão',
            'url.required' => 'Informe a URL do botão'
        ];
    }
}
