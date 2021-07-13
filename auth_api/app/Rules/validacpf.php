<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class validacpf implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $documento)
    {
        $status = false;
        
        // Verifica se um número foi informado
        if(!empty($documento)) {
            
            // Elimina possivel mascara
            $documento = preg_replace("/[^0-9]/", "", $documento);

            // Verifica se nenhuma das sequências invalidas abaixo 
            // foi digitada. Caso afirmativo, retorna falso
            if (strlen($documento) == 11 && $documento != '00000000000' && $documento != '11111111111' && $documento != '22222222222' && $documento != '33333333333' && $documento != '44444444444' && $documento != '55555555555' && $documento != '66666666666' && $documento != '77777777777' && $documento != '88888888888' && $documento != '99999999999') {
               
                for ($t = 9; $t < 11; $t++) {
                    for ($d = 0, $c = 0; $c < $t; $c++) {
                        $d += $documento{$c} * (($t + 1) - $c);
                    }
                    $d = ((10 * $d) % 11) % 10;
                    if ($documento{$c} != $d) {
                        return false;
                    }
                }

                return true;

            }

        } 

        return $status === true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'CPF Inválido';
    }
}
