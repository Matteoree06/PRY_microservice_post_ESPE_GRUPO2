<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class CheckAuthToken
{
    public function handle(Request $request, Closure $next)
    {
        // 1 Obtener token desde Authorization: Bearer XXXX
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Token requerido'
            ], 401);
        }

        try {
            // 2 Cliente HTTP para consumir el microservicio de autenticación (MS1)
            $client = new Client([
                'base_uri' => env('AUTH_SERVICE_URL'), // ej: http://localhost:8000
                'timeout'  => 5,
            ]);

            // 3 Consumir el endpoint GET /api/validate-token en MS1
            $response = $client->get('/api/validate-token', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'Accept'        => 'application/json', // importante para recibir JSON
                ],
            ]);

            // 4 Decodificar respuesta JSON
            $data = json_decode($response->getBody(), true);

            // 5 Validar respuesta del microservicio de autenticación
            if (!isset($data['valid']) || $data['valid'] !== true) {
                return response()->json([
                    'message' => $data['message'] ?? 'Token inválido'
                ], 401);
            }

            // 6. Token válido → continuar con la petición
            return $next($request);

        } catch (ClientException $e) {
            // Captura errores 401 de MS1 (token inválido o expirado)
            $status = $e->getResponse() ? $e->getResponse()->getStatusCode() : 401;

            return response()->json([
                'message' => $status === 401 ? 'Token inválido o expirado' : 'Error al validar token con el microservicio'
            ], $status);

        } catch (\Exception $e) {
            // Otros errores de conexión o timeout
            return response()->json([
                'message' => 'Error al conectar con el microservicio de autenticación'
            ], 500);
        }
    }
}
