<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminCheck
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
        if(Auth::check()){
            if(Auth::user()->is_admin === 0){
                
                $userController = new \App\Http\Controllers\UserController();
                $userController->logoutApi();
                throw new \Exception('Operation is not permited!');
            }
        }
        return $next($request);
    }
}
