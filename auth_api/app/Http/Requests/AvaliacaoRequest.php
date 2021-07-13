<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AvaliacaoRequest extends FormRequest
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
            case $request->isMethod('put'):
                $rules =  [
                    'pergunta_id' => 'required',
                    'avaliacao' => 'required|integer|min:1|max:5', 
                ]; 
                break; 
        } 
        return $rules;  
    }

    public function messages()
    {
        return [  
            'pergunta_id.required' => 'Id pergunta é obrigatório' , 
            'avaliacao.required' => 'Valor da avaliacao é obrigatório' , 
            'avaliacao.integer' => 'Valor da avaliacao é obrigatório ser valor inteiro' , 
            'avaliacao.min' => 'Valor minimo para avaliação é 1' , 
            'avaliacao.max' => 'Valor máximo para avaliação é 5' , 
        ];
    }
}
