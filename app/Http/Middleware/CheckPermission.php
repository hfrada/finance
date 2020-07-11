<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed 
     */
    public function handle($request, Closure $next)
    {
        $permission = array_slice(func_get_args(), 2);

        $userPermission = explode(',', Auth::guard('super_user')->user()->role->permission);

        foreach ($userPermission as $value)
            if (in_array($value, $permission)) 
                return $next($request);

        return response('You havent permission to access this url!', 401);
    }
}
