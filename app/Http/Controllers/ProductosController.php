<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Usuarios;
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
        $rutaImagen = null;

        if($request->hasFile('imagen')){
            $rutaImagen = $request->file('imagen')->store('productos','public');
        }

        Productos::create([
            'nombre'=> $request->nombre,
            'descripcion'=> $request->descripcion,
            'precio'=> $request->precio,
            'stock'=> $request->stock,            
            'categoria'=> $request->categoria,
            'codigo'=> $request->codigo,
            'imagen'=> $rutaImagen,
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
     * FUNCIONES PARA HACER LA MODIFICACIÓN DE LOS REGISTROS
     */
    public function edit(Productos $Producto)
    {
        return view('Productos.edit', compact('Producto'));   
    }

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

        $data = $request->all();
        if($request->hasFile('imagen')){
            $data['imagen'] = $request->file('imagen')->store('productos','public');
        } else {
            unset($data['imagen']); 
        }

        $Producto->update($data);

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
