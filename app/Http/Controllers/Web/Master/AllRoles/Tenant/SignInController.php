<?php

namespace App\Http\Controllers\Web\Master\AllRoles\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Master\AllRoles\Tenant\SignIn\SignInRequestValidation;

class SignInController extends Controller
{
    //

    public function showTenantSignInForm()
    {
    	return view('master.all_roles.tenant.signin');
    }

    public function tenantSignIn(SignInRequestValidation $request)
    {
    	return redirect(env('APP_PROTOCOL') . $request->input('subdomain') . '.' . env('APP_ROOT_DOMAIN'));
    }
}
