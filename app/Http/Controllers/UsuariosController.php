<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;

class UsuariosController extends Controller
{
    /**
     * Consulta de información
     */
    public function index()
    {
         //obter todos los datos de la Base de datos
        $Usuarios = Usuarios::all();

        //Regresar vista y enviar los datos obtenidos de la base de datos
        return view('Usuarios.index', compact('Usuarios'));
    }

    /**
     * Mostrar vista para el registro
     */
    public function create()
    {
        return view('Usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Usuarios::create([
            'nombre'=> $request->name,
            'apellido'=> $request->apellido,
            'materno'=> $request->materno,
            'telefono'=> $request->telefono,            
            'email'=> $request->email,
            'password'=> $request->password,
            'direccion'=> $request->direccion,
        ]);

        //enviar al usuario al formulario ciando se han guardado los datos
        return redirect()->route('Usuarios.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Consulta por ID
     */
    public function edit(Usuarios $Usuario)
    {
        return view('Usuarios.edit', compact('Usuario'));     
    }

    /**
     * Actualizar usuario
     */
    public function update(Request $request, Usuarios $Usuario)
    {
        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'materno'=>'required',
            'telefono'=>'required',      
            'email'=>'required',  
            'password'=>'required',  
            'direccion'=>'required',      
        ]);

        $Usuario->update($request->all());

        return redirect()->route('Usuarios.index')
            ->with('success', 'Registro actualizado');
    }

    /**
     * Eliminar usuario
     */
    public function destroy(Usuarios $Usuario)
    {
        $Usuario->delete();
        return redirect()->route('Usuarios.index')
        ->with('success', 'registro eliminado exitosamente');
        //error o fail
    }
}
