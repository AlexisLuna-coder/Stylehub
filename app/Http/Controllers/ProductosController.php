<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Models\Productos;
use App\Models\User;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //obter todos los datos de la Base de datos
        $Productos = Productos::all();

        //Regresar vista y enviar los datos obtenidos de la base de datos
        return view('Productos.index', compact('Productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Productos::create([
            'nombre'=> $request->nombre,
            'descripcion'=> $request->descripcion,
            'precio'=> $request->precio,
            'stock'=> $request->stock,            
            'categoria'=> $request->categoria,
            'codigo'=> $request->codigo,
            'imagen'=> $request->imagen,
            'estado'=> $request->estado,
        ]);

        //enviar al usuario al formulario ciando se han guardado los datos
        return redirect()->route('Productos.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Productos $Producto)
    {
        return view('Productos.edit', compact('Producto'));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Productos $Producto)
    {
        $request->validate([
            'nombre'=> 'required',
            'descripcion'=> 'required',
            'precio'=> 'required',
            'stock'=>   'required',          
            'categoria'=> 'required',
            'codigo'=> 'required',
            'imagen'=> 'nullable',
            'estado'=> 'required',     
        ]);

        $Producto->update($request->all());

        return redirect()->route('Productos.index')
            ->with('success', 'Registro actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Productos $Producto)
    {
        $Producto->delete();
        return redirect()->route('Productos.index')
        ->with('success', 'Registro eliminado exitosamente');
        //error o fail
    }
}
