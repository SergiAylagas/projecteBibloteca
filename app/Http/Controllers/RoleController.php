<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class RoleController extends Controller 
{
    public function admin() {

        return view('admindashboard');
    }

    public function user() {
        return view('dashboard');
    }
}