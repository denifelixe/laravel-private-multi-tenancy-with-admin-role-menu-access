<?php

namespace App\Http\Controllers\Web\Master\AllRoles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
    	return view('master.all_roles.home');
    }
}
