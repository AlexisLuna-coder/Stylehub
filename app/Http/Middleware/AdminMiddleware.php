<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response{
        //Verificar la sesion activa
        if(!Auth::check()){
            return redirect()->route('registro')
            ->with('error', 'se debe registrar e iniciar sesión');
        }


        //Verificar que la sesión sea de un administrador
        if(!Auth::user()->is_Admin){
            return redirect()->route('Usuarios.index')
            ->with('error', 'No cuentas con permisos de administrador');
        }

        return $next($request);
    }
}