<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordenes;
use App\Models\DetalleOrden;
use App\Models\Productos;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class OrdenesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordenes = Ordenes::all();
        return view('Ordenes.index', compact('ordenes')); //PORDÍA CAMBIAR LA RUTA DE LA VISTA SI ES NECESARIO 2026-04-07
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Productos::all();
        $usuarios = User::all();
        return view('Ordenes.create', compact('productos','usuarios')); //PORDÍA CAMBIAR LA RUTA DE LA VISTA SI ES NECESARIO 2026-04-07
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'direccion_envio' => 'required',
            'metodo_pago' => 'required'
        ]);

        //permite verificar que la cantidad solicitada no exceda el stock disponible antes de crear la orden
        foreach($request->productos as $producto_id => $cantidad){
            if($cantidad > 0){
                $producto = Productos::find($producto_id);
                if($cantidad > $producto->stock){
                    return redirect()->back()
                        ->with('warning', 'No se puede agregar "' . $producto->nombre . '" ya que no se tiene suficiente stock');
                }
            }
        }

        $orden = Ordenes::create([
            'user_id' => ($request->user_id ?? Auth::id()),
            'fecha' => now(),
            'total' => 0,
            'estado' => 'Pendiente',
            'direccion_envio' => $request->direccion_envio ?? Auth::user()->direccion,
            'metodo_pago' => $request->metodo_pago
        ]);

        $total = 0;

        foreach($request->productos as $producto_id => $cantidad){
            if($cantidad > 0){
                $producto = Productos::find($producto_id);

                DetalleOrden::create([
                    'orden_id' => $orden->id,
                    'producto_id' => $producto_id,
                    'cantidad' => $cantidad,
                    'precio' => $producto->precio
                ]);
                //QUITAR STOCK
                $producto->stock -= $cantidad;
                $producto->save();

                $total += $producto->precio * $cantidad;
            }
        }

        $orden->update(['total' => $total]);

        return redirect()->route('Ordenes.index') //ESTA DIRECCIÓN - ROUTE PODRA CAMBIAR (2026-04-07) NOTA. DEBERA SER LA RUTA DONDE SE MUESTREN LAS ORDENES, PUEDE SER LA MISMA VISTA DE INDEX O UNA NUEVA VISTA PARA MOSTRAR LA ORDEN RECIEN CREADA
            ->with('success', 'Orden creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * FORMUALRIO
     */
    public function edit(Ordenes $orden)
    {
        return view('Ordenes.edit', compact('orden'));
    }

    public function update(Request $request, Ordenes $orden)
    {
        $request->validate([
            'estado' => 'required',
            'direccion_envio' => 'required',
            'metodo_pago' => 'required', 
        ]);

        $orden->update($request->all());

        return redirect()->route('Ordenes.index')
            ->with('success', 'Orden actualizada');
    }

    /**
     * ELIMINACIÓN
     */
    public function destroy(Ordenes $orden)
    {
        $orden->delete();

        return redirect()->route('Ordenes.index')
            ->with('success', 'Orden eliminada');
    }
}
