<?php

namespace App\Http\Controllers;

//use App\Models\Usuarios;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //MÉTOODS PARA EL CRUD - GENERAL
    public function index()
    {
        $user = User::all();
        return view('admin.dashboard', compact('user'));
    }
    public function edit(User $user)
    {
        return view('admin.dashboard', compact('user'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required',
            'apellido'=>'required',
            'materno'=>'required',
            'telefono'=>'required',
            'email'=>'required|email',
            'direccion'=>'required',
        ]);

        $data = $request->except('password');

        if($request->password){
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.dashboard')
        ->with('success','Usuario actualizado');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboard')
        ->with('success','Usuario eliminado');
    }

    ///////////////////////////////
    public function registerForm(){
        return view('auth.register');
    }

    //método para guardar información en la base de datos
    public function register(Request $request){

        $request->validate([
            'name' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'materno' => 'required|string|max:100',
            'telefono' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'direccion' => 'required|string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'materno' => $request->materno,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'direccion' => $request->direccion,
            'is_Admin' => $request->has('is_Admin'),
        ]);

        Auth::login($user);

        return redirect()->route('Productos.index')
            ->with('success','Usuario registrado correctamente');
    }

    //Método para regresar vista en inicio de sesión
    public function loginForm(){
        return view('auth.login');
    }

    //método para iniciar sesión
    public function login(Request $request){
        //validar los valores del formulario
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //realizar intento de inicio de sesión
        if(Auth::attempt($data)){
            //Obtener información de la sesión y generar sus credenciales
            $request -> session()->regenerate();

            //Redireccionar al usuario con su sesión iniciada
            //return redirect()->route('Usuarios.index');
            return redirect()->route('Productos.index');
        }

        //Si los datos son incorrectos mandar un error
        return back()->withErrors([
            'email' => 'Datos incorrectos',
        ]);
    }

    //método para cerrar sesión e invalidar las credenciales
    //request recauda infromacion
    public function logout(Request $request){
        //cerrar sesión
        Auth::logout();

        //Cierre de credenciales en las sesiones
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/acceso');
    }

    //Método para el Panel principal del administrador
    public function adminDashboard(){
        $user = User::all();
        return view('admin.dashboard', compact('user'));
    }
}


    