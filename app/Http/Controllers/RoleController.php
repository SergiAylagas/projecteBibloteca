<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class RoleController extends Controller 
{

    

    public function admin() {
        dd('admin view'); // Verifica si llega a este punto
        return view('admin');
    }

    public function user() {
        return view('dashboard');
    }
}