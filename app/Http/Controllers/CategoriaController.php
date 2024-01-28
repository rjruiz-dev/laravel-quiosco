<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index() {
        // dd('Desde API CategoriaController');

        // respuesta json
        // nombre del modelo "Categoria" 
        return response()->json(['categorias' => Categoria::all()]);
    }   
}
