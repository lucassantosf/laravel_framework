<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
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
            'username' => 'required',
            'password' => 'required',
            'tipo' => ['required', Rule::in(['2', '3'])],
        ];
    }



    public function messages()
    {
        $retorno = array(
            'tipo.required' => 'Tipo obrigatório',
            'tipo.in' => 'Selecione entre médico ou usuário',
            'password.required' => 'Senha obrigatória',
        );

        if ($this->get('tipo') == 2) {
            $retorno['username.required'] = 'CPF obrigatório';
        } else {
            $retorno['username.required'] = 'CRM obrigatório';
        }

        return $retorno;
    }

    public function getValidatorInstance()
    {
        $this->clearformat();
        return parent::getValidatorInstance();
    }

    protected function clearformat()
    {
        if($this->request->has('username') && $this->request->has('tipo')){
            if ($this->get('tipo') == 2) {
                $this->merge([
                    'username' => 'cpf_'.str_replace(['-','_','.'], '', $this->request->get('username'))
                ]);
            } else {
                $this->merge([
                    'username' => 'crm_'.str_replace(['-','_','.'], '', $this->request->get('username'))
                ]);
            }
        }
    }
}
