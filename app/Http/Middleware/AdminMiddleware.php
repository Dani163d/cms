<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario tiene el rol de admin
        if (Auth::check() && Auth::user()->role_id === 1) {
            return $next($request);
        }

        // Si el usuario no es admin, redirigir a la página de inicio
        return redirect()->route('home')->with('error', 'No tienes permiso para acceder al área de administración.');
    }
}
