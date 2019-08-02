<?php

namespace App\Http\Controllers\Web\Tenant\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::forUser(Auth::guard('web_tenant_admin')->user())->denies('view-admin-dashboard')) {
            abort(403);
        }
        return view('tenant.admin.dashboard');
    }
}
