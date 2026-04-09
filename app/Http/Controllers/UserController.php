<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Usuarios;
use App\Models\Productos;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('admin-dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function edit(User $Usuario)
    {
        return view('Usuarios.edit', compact('Usuario'));
    }

    public function update(Request $request, User $Usuario)
    {
        $request->validate([
            'name'=>'required',
            'apellido'=>'required',
            'materno'=>'required',
            'telefono'=>'required',
            'email'=>'required|email',
            'direccion'=>'required',
            'user_Type'=>'required'
        ]);

        $data = $request->except('password');

        if($request->password){
            $data['password'] = Hash::make($request->password);
        }

        $Usuario->update($data);

        return redirect()->route('admin-dashboard')
            ->with('success','Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $Usuario)
    {
        $Usuario->delete();

        return redirect()->route('admin-dashboard')
            ->with('success','Eliminado');
    }
}
