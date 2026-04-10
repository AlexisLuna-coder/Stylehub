<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    //use App\Models\Usuarios;
    use App\Models\Productos;
    use App\Models\User;
    use App\Models\Ordenes;

    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;


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

        //FUNCIONES PARA EL PROFILE
        /**
         * Muestra la vista del perfil del usuario logueado con sus órdenes.
         */
        public function userProfile()
        {
            // Obtenemos al usuario que tiene la sesión iniciada
            // Cargamos sus 'ordenes' (y los 'productos' de esas órdenes) para mostrarlos en el historial
            $usuario = User::with('ordenes.productos')->findOrFail(Auth::id());

            return view('Usuarios.profile', compact('usuario'));
        }

        /**
         * Actualiza solo la contraseña desde el Modal del perfil
         */
        public function updatePassword(Request $request)
        {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed', // Requiere el campo new_password_confirmation
            ]);

            $user = User::findOrFail(Auth::id());

            // Verificamos que la contraseña actual sea correcta
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'La contraseña actual no coincide.');
            }

            // Actualizamos
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return redirect()->route('Usuario.profile')
            ->with('success', 'Contraseña actualizada con éxito.');
        }
    }
