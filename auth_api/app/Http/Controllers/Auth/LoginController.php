<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/cms/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required'
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('dashboard'));
        }   

        // if unsuccessful, then redirect back to the login with the form data
        Session::flash('message', 'Usuário e/ou senha inválido(s)!');
        Session::flash('class', 'danger');
        return redirect()->back()->withInput($request->only('username', 'remember'));
    }

    /* Sobrepor a função de levar até a página de login */
    public function showLoginForm()
    {
        $title = "Faça o login para continuar";
        return view('cms.auth.login', compact('title'));
    }

    /* Sobrepor a função de logout */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}