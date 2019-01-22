<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CadastrosController extends Controller
{
    public function indexUser(){
    	return view('cadastros.user');
    }

    public function indexPlans(){
    	return view('cadastros.plan');
    }

    public function indexProducts(){
    	return view('cadastros.product');
    }

    public function indexModals(){
    	return view('cadastros.modal');
    }

    public function indexClients(){
    	return view('cadastros.client');
    }

    public function indexClientsAdd(){
    	return view('cadastros.clientadd');
    }
}
