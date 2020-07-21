<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Http;

class DeputadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // pedimos a lista de deputados em exercicio
        $response = Http::get('http://dadosabertos.almg.gov.br/ws/deputados/em_exercicio?formato=json');

        foreach ($response->json()["list"] as $dep) {
            // para cada deputado na lista, criamos um deputado no modelo
            App\Deputado::createDeputado($dep);
        }
    }
}
