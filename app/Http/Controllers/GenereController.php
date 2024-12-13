<?php

namespace App\Http\Controllers;

use App\Models\Genere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenereController extends Controller
{
    /**
     * Mostra el formulari de pujada amb els gèneres.
     */
    public function show()
    {
        $generes = Genere::all(); 
        dd($generes); // Mostra el contingut de $generes
    }
}
