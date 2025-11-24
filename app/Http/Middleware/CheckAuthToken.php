<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuthToken
{
    /**
     * Maneja la petición entrante.
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Leer el token que viene en el header
        //    Puedes escoger un nombre; usaremos X-API-TOKEN
        $headerToken = $request->header('X-API-TOKEN');

        // 2. Leer el token configurado en .env
        $validToken = env('API_AUTH_TOKEN');

        // 3. Validar
        if (!$headerToken || $headerToken !== $validToken) {
            // Si no hay token o es incorrecto devolvemos 401
            return response()->json([
                'message' => 'Token de autenticación inválido o ausente.',
            ], 401);
        }

        // 4. Si el token es correcto, dejamos pasar la petición
        return $next($request);
    }
}
