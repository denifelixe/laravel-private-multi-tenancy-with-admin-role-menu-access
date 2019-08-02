<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    // 'defaults' => [
    //     'guard' => 'web_master_superadmin',
    //     'passwords' => 'web_master_superadmins',
    // ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        // 'web' => [
        //     'driver' => 'session',
        //     'provider' => 'users',
        // ],

        // 'api' => [
        //     'driver' => 'token',
        //     'provider' => 'users',
        //     'hash' => false,
        // ],

        'web_master_superadmin' => [
            'driver' => 'session',
            'provider' => 'web_master_superadmins',
        ],

        'web_tenant_superadmin' => [
            'driver' => 'session',
            'provider' => 'web_tenant_superadmins',
        ],

        'web_tenant_admin' => [
            'driver' => 'session',
            'provider' => 'web_tenant_admins',
        ],

        'api_tenant_superadmin' => [
            'driver' => 'passport',
            'provider' => 'superadmins',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        // 'users' => [
        //     'driver' => 'eloquent',
        //     'model' => App\User::class,
        // ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],

        'web_master_superadmins' => [
            'driver' => 'eloquent',
            //https://laravel.com/docs/5.8/authentication#adding-custom-user-providers 

            /*
                trait CreatesUserProviders (Illuminate\Auth\CreatesUserProviders) 

                case 'eloquent': return $this->createEloquentProvider($config); (line 39-40)

                protected function createEloquentProvider($config) (line 80)
                {
                    return new EloquentUserProvider($this->app['hash'], $config['model']);
                }

                returning Illuminate\Auth\EloquentUserProvider implementing Illuminate\Contracts\Auth\UserProvider contract/interface (Read about "The User Provider Contract" section in the documentation) (The UserProvider (in this example Illuminate\Auth\EloquentUserProvider) must implement the Illuminate\Contracts\Auth\UserProvider contract/interface)
            */
            'model' => App\Models\Master\SuperAdmins\SuperAdminModel::class, 
            //https://laravel.com/docs/5.8/authentication#adding-custom-user-providers

            /*
                Model should implements Illuminate\Contracts\Auth\Authenticatable contract/interface. 
                It should implementing that interface because in the UserProvider (in this example EloquentUserProvider) class some of the method use the function from Authenticatable interface,
                for example method retrieveById use $model->getAuthIdentifierName() from the model (line 51 in Illuminate\Auth\EloquentUserProvider)
                (Read about "The Authenticatable Contract" section in the documentation)
            */
        ],

        'web_tenant_superadmins' => [
            'driver' => 'eloquent', 
            'model' => App\Models\Tenant\SuperAdmins\SuperAdminModel::class, 
        ],

        'web_tenant_admins' => [
            'driver' => 'eloquent', 
            'model' => App\Models\Tenant\Admins\AdminModel::class, 
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'web_master_superadmins' => [
            'provider' => 'web_master_superadmins',
            'table' => 'superadmin_password_resets',
            'expire' => 60,
        ],
    ],

];
