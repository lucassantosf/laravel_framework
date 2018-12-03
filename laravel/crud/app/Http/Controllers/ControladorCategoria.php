<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class ControladorCategoria extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $cats = Categoria::all();
        return view('categorias',compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('novacategoria');
    }

    public function store(Request $request){
        $cat = new Categoria();
        $cat->nome = $request->input('nomecategoria');
        $cat->save();   
        return redirect('/categorias');  
    }
    
    public function show($id)
    {
        
    }
    
    public function edit($id)
    {
        $cat = Categoria::find($id);
        if(isset($cat)){
            return view('editarcategoria',compact('cat'));
        }
        return redirect('/categorias');
    }
    
    public function update(Request $request, $id)
    {
        $cat = Categoria::find($id);
        if(isset($cat)){
            $cat->nome = $request->input('nomecategoria');
            $cat->save();
        }
        return redirect('/categorias');
    }

    public function destroy($id)
    {
        $cat = Categoria::find($id);
        if(isset($cat)){
            $cat->delete();
        }
        return redirect('/categorias');
    }

}
