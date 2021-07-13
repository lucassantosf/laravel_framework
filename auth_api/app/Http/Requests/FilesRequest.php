<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilesRequest extends FormRequest
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
            'file'=>'required|dimensions:min_width=1000|max:500'
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
            'file.required'=>'Escolha uma imagem',
            'file.max'=>'O peso da imagem deve ser no máximo :size kb',
            'file.dimensions'=>'A largura mínima da imagem deve ser :min_widthpx',
        ];
    }
}
