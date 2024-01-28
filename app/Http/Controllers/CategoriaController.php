<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaCollection;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index() {
        // dd('Desde API CategoriaController');

        // 1er tipo de respuesta json        
        // return response()->json(['categorias' => Categoria::all()]); // nombre del modelo "Categoria"  
        
        // 2do tipo de respuesta json
        return new CategoriaCollection(Categoria::all());
    }   
}
