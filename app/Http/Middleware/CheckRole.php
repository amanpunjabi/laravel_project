<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if($request->user() === null){
            return response("insufficient permisssions",401);
        }
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles'])?$actions['roles']:null;
        // dd($roles);
        if($request->user()->hasAnyRole($roles))
        {
            return $next($request);
        }
        return response("insufficient permisssions",401);
    }
}
