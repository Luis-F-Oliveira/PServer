<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\RoleOnUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        $roles = RoleOnUser::where('user_id', $user->id)->with('role')->get();
        $currentRoles = $roles->pluck('role.name', 'role.key')->toArray();

        $response = $next($request);

        if ($response instanceof \Illuminate\Http\JsonResponse) {
            $response = response()->make($response->getContent(), $response->status());
        }

        foreach ($currentRoles as $key => $value) {
            $cookie = cookie($value, $key, 60 * 24, null, null, false, false);
            $response->headers->setCookie($cookie);
        }

        return $response;
    }
}
