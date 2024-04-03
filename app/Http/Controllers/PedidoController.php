<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pedido;
use App\Models\PedidoProducto;
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
        // almacenar una orden
        $pedido = new Pedido;
        $pedido->user_id = Auth::user()->id; // forma de obtener el usuario autenticado
        $pedido->total = $request->total;    //  forma de leer el pedido es a traves de request (importante mismo nombre que tiene en la peticion con axios)
        $pedido->save(); // almacenar en la base de datos

        // obtener el id del pedido al cual pertenecen los productos 
        $id = $pedido->id;

        // obtener los productos
        $productos = $request->productos;
       
        // formatear un arreglo
        $pedido_producto = [];

        foreach($productos as $producto) {
            $pedido_producto[] = [
                'pedido_id' => $id,
                'producto_id' => $producto['id'],
                'cantidad' => $producto['cantidad'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // almacenar en la db
        PedidoProducto::insert($pedido_producto); // PedidoProducto es el modelo
        
        return [
            'message' => 'realizando pedido correctamente, estará listo en unos minutos'
            // 'message' => 'realizando pedido' . $pedido->id,
            // 'productos' => $request->productos
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
