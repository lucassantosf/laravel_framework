<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PerguntaRequest extends FormRequest
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
    public function rules(Request $request)
    {
        switch(true) {
            case $request->isMethod('post'):
                return [
                    'especialidade_id' => 'required',
                    'texto' => 'required'
                ];
                break;
            case $request->isMethod('put'):
                $rules =  [
                    'pergunta_id' => 'required',
                    'replica' => 'required',
                ];
                break;
        }
        return $rules;
    }

    /**
     * Array de mensagens personalizadas dos campos obrigatórios
     *
     * @return array
     */
    public function messages()
    {
        return [
            'especialidade_id.required' => 'Id especialidade obrigatório' ,
            'texto.required' => 'Texto da pergunta é obrigatório' ,
            'pergunta_id.required' => 'Id pergunta é obrigatório' ,
            'replica.required' => 'Texto da replica é obrigatório' ,
        ];
    }
}
