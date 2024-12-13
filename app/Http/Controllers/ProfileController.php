<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; 
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        //En primer lloc si es passa imatge es borra la imatge actual
        if ($request->hasFile('image')) {
            if (Auth::user()->image) {
                Storage::disk('public')->delete(Auth::user()->image);
            }
        }
        $user = $request->user(); //recuperem l'objecte amb les dades de l'usuari
        $user->fill($request->validated()); //omplim amb les dades validades
        
        //si es modifica el mail, posem a null el camp verificat

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        
        if ($request->hasFile('image')) {
        //si es passa imatge es crea el nom i la ruta   
            $extension = $request->file('image')->getClientOriginalExtension(); //recuperem la extensio
            $imageName = $user->id . '.' . $extension; //nom imatge = id.extensio
            $path = $request->file('imatge')->storeAs('profile_images', $imageName, 'public'); //creem el path
            // $path = File::p
            $user->image= $path; //actualitzem el camp imatge de l'usuari per preparar-lo per la BD
  
        }
        $request->user()->save(); //desem a la BD

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}