<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class ProdutoController extends Controller
{
    public function indexProds(){
    	$i = 0 ;
    	$prods = Produto::all();
    	return view('cadastros.formProduct',compact('i','prods'));
    }

    public function formProd(){
    	$i = 1 ;
    	return view('cadastros.formProduct',compact('i'));
    }

    public function postformProd(Request $request){
    	$prod = new Produto();
    	$prod->name = $request->input('name');
    	$prod->value = $request->input('value');
    	$prod->status = $request->input('status') == 'A' ? true : false;
    	$prod->save();
    	return redirect('/cadastros/products');
    }

    public function formProdEdit($id){
    	$prod = Produto::find($id);
    	if(isset($prod)){
    		$i = 1 ;
    		return view('cadastros.formProduct',compact('i','prod'));
    	}
    	return redirect('/cadastros/products');
    }

    public function postformProdEdit(Request $request, $id){
    	$prod = Produto::find($id);
    	if(isset($prod)){
    		$prod->name = $request->input('name');
	    	$prod->value = $request->input('value');
	    	$prod->status = $request->input('status') == 'A' ? true : false;
	    	$prod->save();
    	}
    	return redirect('/cadastros/products');

    }

    public function destroyProd($id){
    	$prod = Produto::find($id);
    	if(isset($prod)){
    		$prod->delete();
    	}
    	return redirect('/cadastros/products');
    }

}
