<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            $response = response()->json([
                'message' => 'Unauthorized'
            ], 401);

            $response->headers->setCookie(Cookie::forget('jwt'));
            return $response;
        }

        $response = $next($request);
        $cookie = cookie('jwt', httpOnly:false);

        if ($response instanceof \Illuminate\Http\JsonResponse) {
            $response = response()->make($response->getContent(), $response->status());
        }

        $response->headers->setCookie($cookie);
        return $response;
    }
}