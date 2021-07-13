<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EspecialidadeAlterarRequest extends FormRequest
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
     * Array de campos obrigatórios do conteúdo
     *
     * @return array
     */
    public function rules()
    {
        return [
            'especialidade_id_from'=>'required',
            'especialidade_id_to'=>'required'
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
            'especialidade_id_from.required'=>'Especialidade_id_from obrigatório, especialidade antiga',
            'especialidade_id_to.required'=>'Especialidade_id_to obrigatório, especialidade nova'
        ];
    }
}
