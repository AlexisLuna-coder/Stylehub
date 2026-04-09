<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleOrden;
use App\Models\Ordenes;
use App\Models\Productos;

class DetalleOrdenController extends Controller
{
    /**
     * Mostrar todos los detalles de órdenes
     */
    public function index()
    {
        $detalles = DetalleOrden::with(['orden', 'producto'])->get();
        return view('DetalleOrden.index', compact('detalles'));
    }

    /**
     * Mostrar formulario para crear detalle
     */
    public function create()
    {
        $ordenes = Ordenes::all();
        $productos = Productos::all();

        return view('DetalleOrden.create', compact('ordenes', 'productos'));
    }

    /**
     * Guardar detalle de orden
     */
    public function store(Request $request)
    {
        $request->validate([
            'orden_id' => 'required',
            'producto_id' => 'required',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0'
        ]);

        DetalleOrden::create($request->all());

        return redirect()->route('DetalleOrden.index')
            ->with('success', 'Detalle de orden creado');
    }

    /**
     * Mostrar un detalle específico
     */
    public function show(DetalleOrden $detalleOrden)
    {
        return view('DetalleOrden.show', compact('detalleOrden'));
    }

    /**
     * Formulario de edición
     */
    public function edit(DetalleOrden $detalleOrden)
    {
        $ordenes = Ordenes::all();
        $productos = Productos::all();

        return view('DetalleOrden.edit', compact('detalleOrden', 'ordenes', 'productos'));
    }

    /**
     * Actualizar detalle
     */
    public function update(Request $request, DetalleOrden $detalleOrden)
    {
        $request->validate([
            'orden_id' => 'required',
            'producto_id' => 'required',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0'
        ]);

        $detalleOrden->update($request->all());

        return redirect()->route('DetalleOrden.index')
            ->with('success', 'Detalle actualizado');
    }

    /**
     * Eliminar detalle
     */
    public function destroy(DetalleOrden $detalleOrden)
    {
        $detalleOrden->delete();

        return redirect()->route('DetalleOrden.index')
            ->with('success', 'Detalle eliminado');
    }
}