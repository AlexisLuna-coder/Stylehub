<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Usuarios;
use App\Models\Productos;
use App\Models\User;

use Illuminate\Support\Facades\Http; //2026-04-09 - IMPLEMENTACIÓN DE HTTP PARA CONSUMO DE API EXTERNA

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

    //MÉTODO PARA IMPLEMENTAR EL CONSUMO DE LA API EXTERNA
    public function home(Request $request) {
        // // 1. Obtener productos de una categoría específica (ej. Clothes - ID: 1)
        // $ropa = Http::get('https://api.escuelajs.co/api/v1/products', [
        //     'categoryId' => 1,
        //     'limit' => 5
        // ])->json() ?? [];

        // // 2. Obtener productos de otra categoría (ej. Electronics o Shoes - ID: 2)
        // $zapatos = Http::get('https://api.escuelajs.co/api/v1/products', [
        //     'categoryId' => 2,
        //     'limit' => 5
        // ])->json() ?? [];

        // return view('Productos.home', compact('ropa', 'zapatos'));

        $filtros = [
            'title'     => $request->query('titulo'),
            'price_min' => $request->query('min'),
            'price_max' => $request->query('max'),
            'categoryId'=> $request->query('categoria'),
        ];

        // Limpiamos los filtros nulos para no enviarlos vacíos
        $query = array_filter($filtros);

        // Hacemos la petición con los parámetros dinámicos
        $resultados = Http::get('https://api.escuelajs.co/api/v1/products/', $query)->json() ?? [];

        return view('Productos.home', compact('resultados'));

    }
}
