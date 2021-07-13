<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
	//Apenas redirecionar para tela de login CMS
	public function home(){
        return redirect()->route('dashboard');
    }

    public function index(){
    	$usuarios = User::all();
        $title = 'Dashboard';
        return view('cms.dashboard', compact('title', 'usuarios'));
    }
}
