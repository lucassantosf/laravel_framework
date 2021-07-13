<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacoteRequest extends FormRequest
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
            'descricao' => 'required',
            'valor' => 'required',
            'especialidades' => 'required',
            'perguntas' => 'required',
            'trocas_especialidade' => 'required',
            'status' => 'required',
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
            'descricao.required'=>'Descrição do pacote obrigatório',
            'valor.required'=>'Valor do pacote obrigatório',
            'especialidades.required'=>'Quantidade de especialidades obrigatório',
            'perguntas.required'=>'Quantidade de perguntas do pacote obrigatório',
            'trocas_especialidade.required'=>'Quantidade de trocas de especialidades obrigatório' ,
            'status.required'=>'Definir um status é obrigatório'
        ];
    }
}
