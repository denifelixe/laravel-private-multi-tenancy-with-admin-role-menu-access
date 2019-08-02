<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| command "php artisan route:list" to see all the route lists.
|
*/

// Controllers Within The "App\Http\Controllers\Web" Namespace
Route::namespace('Web')->group(function () {

	/**
	 * In order to ensure your sub-domain routes are reachable, you should 
	 * register sub-domain routes before registering root domain routes.  
	 * This will prevent root domain routes from overwriting
	 * sub-domain routes which have the same URI path.
	 */
	Route::domain('{tenant}.' . env('APP_ROOT_DOMAIN'))->group(function ($tenant) {

	    // Controllers Within The "App\Http\Controllers\Web\Tenant" Namespace
	    Route::namespace('Tenant')->group(function () {

	    	Route::namespace('AllRoles')->group(function () {

				Route::get('/', 'HomeController@index')->name('web.tenant.home');

			});

	    	Route::namespace('SuperAdmin')->group(function () {

		        Route::get('superadmin/register', 'Auth\RegisterController@showSuperAdminRegistrationForm')->name('web.tenant.superadmin.register');
	            Route::post('superadmin/register', 'Auth\RegisterController@superAdminRegister');

				Route::get('superadmin/login', 'Auth\LoginController@showSuperAdminLoginForm')->name('web.tenant.superadmin.login');
		        Route::post('superadmin/login', 'Auth\LoginController@superAdminLogin');

				Route::middleware(['web.tenant.superadmin.auth'])->group(function () {
				    
				    Route::get('superadmin', 'DashboardController@index')->name('web.tenant.superadmin.dashboard');

				    // Admin Roles
					    Route::get('superadmin/admin_role/create', 'AdminRoleController@showCreateRoleForm')->name('web.tenant.superadmin.admin_role.create');
					    Route::post('superadmin/admin_role/create', 'AdminRoleController@createRole');

					// Admin Role Menus Access
					    Route::get('superadmin/admin_role/{admin_role_id}/menu_access', 'AdminRoleMenuWebAccessController@showAdminRoleMenuWebAccessByAdminRoleId')->name('web.tenant.superadmin.admin_role_menu_web_access');

					    Route::get('superadmin/admin_role/{admin_role_id}/menu_access/edit', 'AdminRoleMenuWebAccessController@showAdminRoleMenuWebAccessByAdminRoleIdEditForm')->name('web.tenant.superadmin.admin_role_menu_web_access.edit');
					    Route::put('superadmin/admin_role/{admin_role_id}/menu_access/update', 'AdminRoleMenuWebAccessController@updateAdminRoleMenuWebAccessByAdminRoleId')->name('web.tenant.superadmin.admin_role_menu_web_access.update');

					// SuperAdmin Logout
			        	Route::post('superadmin/logout', 'Auth\LoginController@superAdminLogout')->name('web.tenant.superadmin.logout');
			        
				});

           	});

	    	Route::namespace('Admin')->group(function () {

				Route::get('admin/login', 'Auth\LoginController@showAdminLoginForm')->name('web.tenant.admin.login');
				Route::post('admin/login', 'Auth\LoginController@adminLogin');

				Route::middleware(['web.tenant.superadmin.auth'])->group(function () {
					
					Route::get('admin/register', 'Auth\RegisterController@showAdminRegistrationForm')->name('web.tenant.admin.register');
					Route::post('admin/register', 'Auth\RegisterController@adminRegister');
					
				});

	    		Route::middleware(['web.tenant.admin.auth'])->group(function () {
				    
				    Route::get('admin', 'DashboardController@index')->name('web.tenant.admin.dashboard');

				    Route::post('admin/logout', 'Auth\LoginController@adminLogout')->name('web.tenant.admin.logout');

				});

	    	});

		});

	});

	// Controllers Within The "App\Http\Controllers\Web\Master" Namespace
	Route::namespace('Master')->group(function () {

		Route::namespace('AllRoles')->group(function () {

			Route::get('/', 'HomeController@index')->name('web.master.home');

			Route::get('tenant/signin', 'Tenant\SignInController@showTenantSignInForm')->name('web.master.all_roles.tenant.signin');
			Route::post('tenant/signin', 'Tenant\SignInController@tenantSignIn');

		});

		Route::namespace('SuperAdmin')->group(function () {
				
			Route::get('superadmin/register', 'Auth\RegisterController@showSuperAdminRegistrationForm')->name('web.master.superadmin.register');
			Route::post('superadmin/register', 'Auth\RegisterController@superAdminRegister');

			Route::get('superadmin/login', 'Auth\LoginController@showSuperAdminLoginForm')->name('web.master.superadmin.login');
			Route::post('superadmin/login', 'Auth\LoginController@superAdminLogin');				


			Route::middleware(['web.master.superadmin.auth'])->group(function () {
				
				Route::get('superadmin', 'DashboardController@index')->name('web.master.superadmin.dashboard');

				Route::get('superadmin/tenant/register', 'Tenant\RegisterController@showTenantRegistrationForm')->name('web.master.superadmin.tenant.register');
				Route::post('superadmin/tenant/register', 'Tenant\RegisterController@tenantRegister');

				Route::post('superadmin/logout', 'Auth\LoginController@superAdminlogout')->name('web.master.superadmin.logout');

			});

		});

	});

});