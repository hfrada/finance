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
        $result = [];

        $userId = Auth::guard('super_user')->user()->id;

        $permission = array_slice(func_get_args(), 2);

        $userPermission = Auth::guard('super_user')->user()->hasPermission($userId, $permission);

        foreach ($userPermission as $value) if (in_array($value, $permission)) $result[] = True;

        if (count($result) > 0) return $next($request);
        else return response('You havent permission to access this page', 401);
    }
}
