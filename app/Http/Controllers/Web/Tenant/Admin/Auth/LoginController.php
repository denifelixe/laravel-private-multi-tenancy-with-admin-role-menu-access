<?php

namespace App\Http\Controllers\Web\Tenant\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Tenant\AllRoles\Admin\Login\LoginRequestValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //
    
    public function showAdminLoginForm()
    {
        return view('tenant.admin.auth.login');
    }

    public function adminLogin(LoginRequestValidation $request)
    {   
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web_tenant_admin')->attempt($credentials)) {
            /*
                Illuminate\Auth\AuthManager -> Illuminate\Auth\SessionGuard -> Illuminate\Auth\EloquentUserProvider -> \Illuminate\Contracts\Auth\Authenticatable
                

                1. Auth Facade
                    The Auth Facade is the instance of Illuminate\Auth\AuthManager class.
                
                2. The guard() method
                    The guard's driver define the method shall be run.
                    For example if the guard's driver is "session" then the guard method from Auth Facade (instance of Illuminate\Auth\AuthManager class) return the instance of Illuminate\Auth\SessionGuard class because it run createSessionDriver method from $driverMethod = 'create'.ucfirst($config['driver']).'Driver' (line 91-95).

                3. The attempt() method
                    Illuminate\Auth\SessionGuard method public function attempt(array $credentials = [], $remember = false) (line 345).

                    3.1. retrieveByCredentials() method
                        $user = $this->provider->retrieveByCredentials($credentials); (SessionGuard line 349) returning the user instance of the eloquent model that implements \Illuminate\Contracts\Auth\Authenticatable contract/interface or returning null.
                        returning eloquent model of user instance should implementing \Illuminate\Contracts\Auth\Authenticatable contract/interface.
                        
                        3.1.1. $this->provider property
                            If the user provider driver use 'eloquent' then the UserProvider ($this->provider) is the object from class Illuminate\Auth\EloquentUserProvider, and must implement the Illuminate\Contracts\Auth\UserProvider contract/interface.
                        
                        3.1.2. The retrieveByCredentials() method
                            In Illuminate\Auth\EloquentUserProvider, on method retrieveByCredentials (EloquentUserProvider line 106), the method find the user instance of the model (the model is from the user provider's model in config, in this example is the instance of App\Models\Master\Superadmins\SuperadminsModel model) by querying it $query->where($key, $value) (EloquentUserProvider line 127) and get the user instance by returning $query->first() (line 131). 
                            
                            The $key and $value is got from credentials (but not with key with "password" contain word: 
                            if (Str::contains($key, 'password')) {
                                continue;
                            } (line 120-122).

                            In this example the credentials is ['email' => 'user@email.example', 'password' => 'user_password'], so the $key and $value is 'email' and 'user@email.example' ($query->where('email', 'user@email.example') (line 127)).

                            If you want to check the user by another column in db instead an email, you can change the credentials by the column you want, for example you want to check by username then you define the credentials with ['username' => 'user_name', 'password' => 'user_password'].

                    3.2. hasValidCredentials() method
                        If an implementation of Authenticatable was returned, we'll ask the provider to validate the user against the given credentials.
                        $this->hasValidCredentials($user, $credentials) (SessionGuard line 354).

                        3.2.1. validateCredentials() method 
                            $this->provider->validateCredentials($user, $credentials) (SessionGuard line 377)

                            if the user provider driver use 'eloquent' then the UserProvider ($this->provider) is the object from class Illuminate\Auth\EloquentUserProvider, and must implement the Illuminate\Contracts\Auth\UserProvider contract/interface.

                            In Illuminate\Auth\EloquentUserProvider on method validateCredentials (EloquentUserProvider line 141) that returning boolean, the method compare the value of $credentials['password'] (it's hardcoded that's why you should use word 'password' in the request's credentials) with $user->getAuthPassword().

                            $user->getAuthPassword() return the password from the model. 
                            In the default Tenant\Users\UsersModel the getAuthPassword method returning $this->password (Illuminate\Auth\Authenticatable line 41).
                            If you have different password name column in your db like "passwd" you can override this method in your eloquent model that implements \Illuminate\Contracts\Auth\Authenticatable contract/interface to returning $this->passwd.

                        3.2.2. returning hasValidCredentials() method
                            If the retrieved user is not null and validateCredentials() return true then the hasValidCredentials() returning true. 

                    3.3. returning attempt() method 
                        If hasValidCredentials() method return true, then the system will login the user and the attempt() method will return true.


            */

            return redirect()->route('web.tenant.admin.dashboard', ['tenant' => subdomain()]);
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);

    }

    public function adminLogout()
    {
        Auth::guard('web_tenant_admin')->logout();

        return redirect()->route('web.tenant.admin.login', ['tenant' => subdomain()]);
    }

}
