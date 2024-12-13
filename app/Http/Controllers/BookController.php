<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image; // Importa el modelo Image

class BookController extends Controller
{
    public function index()
    {
        // Obtén todas las imágenes con sus descripciones
        $images = Image::with('user')->get();

        // Retorna la vista 'myBooks' con los datos de las imágenes
        return view('myBooks', compact('images'));
    }
}