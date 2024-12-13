<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genere extends Model
{
    use HasFactory;

    protected $table = 'generes'; // Nom explícit de la taula
    protected $fillable = ['name']; // Camps que es poden omplir
}

