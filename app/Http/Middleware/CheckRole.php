<?php

namespace App\Http\Middleware;

use Closure;
//use JWTAuth;
use Exception;
//use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use \App\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        /*
        $user_data = JWTAuth::user();
        return response()->json([
            'status' => auth()->user()->role,
            'user_data' => JWTAuth::user(),
            'role_data' => JWTAuth::user()->role
        ]);
        */

        if (auth()->user() == null) {
            return response()->json(['status' => 'Unauthorized'], 401);
        }

        $user_role = auth()->user()->role['name'];

        $roles_array = explode('|', $roles);
        foreach($roles_array as $role){
            if ($user_role == $role){
                return $next($request);
            }
        }
        return response()->json(['status' => 'Forbidden resource'], 403);

    }
}
