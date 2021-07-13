<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEspecialidadeRequest extends FormRequest
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
            'especialidade_id' => 'required' 
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
            'especialidade_id.required' => 'Id especialidade obrigatório' 
        ];
    }
}
