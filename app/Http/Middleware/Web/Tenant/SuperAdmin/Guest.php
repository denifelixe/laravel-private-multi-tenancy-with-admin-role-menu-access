<?php

namespace App\Http\Middleware\Web\Tenant\SuperAdmin;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class Guest
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
        if (!Auth::guard('web_tenant_superadmin')->check()) {

            return $next($request);

        }        

        return redirect()->route('web.tenant.superadmin.dashboard', ['tenant' => subdomain()]);

    }
}
