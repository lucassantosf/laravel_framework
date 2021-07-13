<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Rules\validacpf;

class CadastroRequest extends FormRequest
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
        $rules = array(
            'name' => 'required|max:190',
            'email' => ['required','unique:users,email', 'max:190'],
            'tipo' => ['required', Rule::in(['2', '3'])],
            'password' => 'required|confirmed|min:6'
        );

        if ($this->get('tipo') == 2) {
            $rules['documento'] = ['required', new validacpf, 'unique:users,username'];
        } else {
            $rules['documento'] = ['required', 'unique:users,username'];
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
        $retorno = array(
            'name.required' => 'Nome obrigatório',
            'email.required' => 'E-mail obrigatório',
            'email.unique' => 'E-mail já utilizado',
            'tipo.required' => 'Tipo obrigatório',
            'tipo.in' => 'Selecione entre médico ou usuário',
            'password.required' => 'Senha obrigatória',
            'password.confirmed' => 'A senha e confirmação de senha não coincidem'
        );

        if ($this->get('tipo') == 2) {
            $retorno['documento.required'] = 'CPF obrigatório';
            $retorno['documento.unique'] = 'CPF já cadastrado';
        } else {
            $retorno['documento.required'] = 'CRM obrigatório';
            $retorno['documento.unique'] = 'CRM já cadastrado';
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
        if($this->request->has('documento') && $this->request->has('tipo')){
            if ($this->get('tipo') == 2) {
                $this->merge([
                    'documento' => 'cpf_'.str_replace(['-','_','.'], '', $this->request->get('documento'))
                ]);
            } else {
                $this->merge([
                    'documento' => 'crm_'.str_replace(['-','_','.'], '', $this->request->get('documento'))
                ]);
            }
        }
    }
}
