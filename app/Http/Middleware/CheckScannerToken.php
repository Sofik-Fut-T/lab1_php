<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckScannerToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('X-Scanner-Token');

        if ($token !== 'scanner-secret-123') {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized scanner device access.',
            ], 401);
        }

        return $next($request);
    }
}
