<?php

namespace App\Http\Controllers\Web\Tenant\AllRoles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
    	return view('tenant.all_roles.home');
    }
}
