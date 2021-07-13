<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RespostaRequest extends FormRequest
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
                    'pergunta_id' => 'required' ,
                    'texto' => 'required' 
                ];
                break; 
            case $request->isMethod('put'):
                return [ 
                    'pergunta_id' => 'required' ,
                    'replica' => 'required' 
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
            'pergunta_id.required' => 'Id pergunta obrigatório' ,
            'texto.required' => 'Texto da resposta é obrigatório' , 
            'replica.required' => 'Replica texto da resposta é obrigatório' , 
        ];
    }
}
