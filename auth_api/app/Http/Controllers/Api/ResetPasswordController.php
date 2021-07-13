<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $redirectTo = '/';

    public function showResetForm(Request $request, $token = null)
    {
               
        $logotipo = asset('assets/images/logo_drresponde.png');
        
        $email = $request->email;
        $title = "Redefinição de Senha";

        return view('cms.auth.passwords.usuariosreset', compact('title', 'token', 'logotipo', 'email'));
    }

    protected function resetPassword($user, $password)
    {
    
        $user->forceFill([
            'password' => bcrypt($password),
        ])->save();
    
        return redirect('/');

    }

    protected function redirect()
    {

        $projeto = Projeto::where('publicado', 1)->first();

        if (!empty($projeto)){
            $logotipo = $this->public_path.$projeto->logo;
        } else {
            $logotipo = asset('assets/cms/images/logo.png');
        }

        $title = "Redefinição de Senha";

         return view('cms.auth.passwords.clientessuccess', compact('title', 'logotipo'));

    }


   /* protected function sendResetResponse(Request $request, $response)
    {
        $response = ['data' => array(
            'sucesso' => 1
        )];

        return response($response, 200);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        $response = ['data' => array(
            'erro' => 2
        )];

        return response($response, 422);
    }*/

}
