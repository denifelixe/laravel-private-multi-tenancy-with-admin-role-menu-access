<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Controllers Within The "App\Http\Controllers\API" Namespace
Route::namespace('API')->group(function () {

	/**
	 * In order to ensure your sub-domain routes are reachable, you should 
	 * register sub-domain routes before registering root domain routes.  
	 * This will prevent root domain routes from overwriting
	 * sub-domain routes which have the same URI path.
	 */
	Route::domain('{tenant}.' . env('APP_ROOT_DOMAIN'))->group(function ($tenant) {
		
		// Controllers Within The "App\Http\Controllers\API\Tenant" Namespace
		Route::namespace('Tenant')->group(function () {

			Route::namespace('SuperAdmin')->group(function () {

				Route::post('superadmin/register/store_verification_code', 'Auth\RegisterController@storeVerificationCode');

			});

		});

	});

	// Controllers Within The "App\Http\Controllers\API\Master" Namespace
	Route::namespace('Master')->group(function () {

		Route::namespace('SuperAdmin')->group(function () {

			Route::post('superadmin/register/store_verification_code', 'Auth\RegisterController@storeVerificationCode');

		});

	});

});