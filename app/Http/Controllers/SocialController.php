<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Social;

class SocialController extends Controller
{
    public function getRedesSociais()
    {
        // usando a função do modelo, retornamos o resultado do query
        // temos os 5 meses em que um deputado mais gastou
        $redesMaisUsadas = Social::redesMaisUsadas();

        // retornamos uma 'response()', transformando o dado em JSON, e o formatando
        return response()->json($redesMaisUsadas, 200, [], JSON_PRETTY_PRINT);
    }
}
