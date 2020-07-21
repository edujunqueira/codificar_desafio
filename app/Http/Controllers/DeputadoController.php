<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Deputado;

class DeputadoController extends Controller
{
    public function getGastadores()
    {
        // usando a função do modelo, retornamos o resultado do query
        // temos os 5 meses em que um deputado mais gastou
        $gastadores = Deputado::gastadores();

        // retornamos uma 'response()', transformando o dado em JSON, e o formatando
        return response()->json($gastadores, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
