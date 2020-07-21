<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function homePage()
    {
        /*
        $gastadores = Http::get('http://localhost:8000/api/gastadores');
        $redesMaisUsadas = Http::get('http://localhost:8000/api/redesSociais');
        return view('home',[
            'gastadores' => $gastadores,
            'redesMaisUsadas' => $redesMaisUsadas
        ]);
        */

        return view('home',[
            'gastadores' => DeputadoController::getGastadoresAnual()->getOriginalContent(),
            'redesMaisUsadas' => SocialController::getRedesSociais()->getOriginalContent()
        ]);

    }
}
