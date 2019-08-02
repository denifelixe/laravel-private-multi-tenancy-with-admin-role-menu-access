<?php

namespace App\Http\Middleware\Web\Master\SuperAdmin;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class Authenticate
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
        if (Auth::guard('web_master_superadmin')->check()) {

            return $next($request);

        }        

        return redirect()->route('web.master.superadmin.login');

    }
}
