<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Admin middleware accessed');
        
        if (!$request->user()) {
            Log::warning('No user authenticated');
            return redirect()->route('login');
        }

        Log::info('User email: ' . $request->user()->email);
        
        // Log de roles
        $roles = $request->user()->roles->pluck('name');
        Log::info('User roles: ' . $roles->implode(', '));

        // Verificación de rol de admin
        if (!$request->user()->hasRole('admin')) {
            Log::warning('User does not have admin role');
            abort(403, 'Acceso no autorizado.');
        }

        Log::info('Admin Middleware: Passed');
        return $next($request);
    }
}