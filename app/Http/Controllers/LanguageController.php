<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function change(Request $request)
    {
        $lang = $request->input ('lang' );
        Session: : put ('locale' , $lang);
        App: : setLopale (Session: :get ('locale' , $lang));

        return redirect()->back();
    }
}
