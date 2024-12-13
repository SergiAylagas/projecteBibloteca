<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Genere;

class ImageController extends Controller
{
    public function index()
    {
        $generes = Genere::all();
        return view('upload', compact('generes'));
    }

    public function filter(Request $request)
    {
        $generes = Genere::all();
        $images = Image::when($request->genere, function ($query, $genere) {
            return $query->where('genere_id', $genere);
        })->get();

    return view('dashboard', compact('images', 'generes'));
    }
    


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string|max:255',
            'genere' => 'required|exists:generes,id',
            'valoration' => 'required|integer|min:1|max:5',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');

            $image = new Image();
            $image->user_id = Auth::id(); // Añadir el user_id del usuario autenticado
            $image->image_path = $imagePath;
            $image->description = $request->description;
            $image->genere_id = $request->genere;
            $image->valoration = $request->valoration;
            $image->save();

            return redirect()->back()->with('success', 'Image uploaded successfully.');
        }

        return back()->withErrors(['image' => 'Image upload failed.']);
    }

    public function myImages()
    {
        $images = Image::all();
        return view('dashboard', compact('images'));
    }

    public function detail($id)
    {
        $image = Image::find($id);
        return view('image', compact('image'));
    }

    public function show($image_id)
    {
        $image = Image::with('user', 'comments.user')->findOrFail($image_id);
        return view('image', compact('image'));
    }
    
}