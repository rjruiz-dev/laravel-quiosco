<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Almacenar una orden
        $pedido = new Pedido;
        $pedido->user_id = Auth::user()->id; // forma de obtener el usuario autenticado
        $pedido->total = $request->total;    //  forma de leer el pedido es a traves de request (importante mismo nombre que tiene en la peticion con axios)
        $pedido->save(); // alamcenar en la base de datos

        // obtener el id del pedido insertado 
        return [
            'message' => 'realizando pedido'
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
