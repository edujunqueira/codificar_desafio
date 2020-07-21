<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Http;

class DespesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pegamos a lista de todos os deputados
        $allDeputados = App\Deputado::all();

        foreach ($allDeputados as $deputado) {

            // Intervalo entre requisições: o intervalo de término de uma requisição e início de outra deve ser de, no mínimo, um segundo.
            sleep(1);

            // get request para a as datas de cada deputado
            $responseData = Http::get('https://dadosabertos.almg.gov.br/ws/prestacao_contas/verbas_indenizatorias/legislatura_atual/deputados/' . $deputado->id . '/datas?formato=json')
                ->json()["list"];

            foreach ($responseData as $resData) {

                // tratamos e separamos as datas
                $stringData = $resData['dataReferencia']['$'];
                $data = DateTime::createFromFormat('Y-m-d', $stringData);
                $ano = $data->format('Y');
                $mes = $data->format('m');

                // como a api só quer os gastos de 2019, vamos otimizar
                if($ano == 2019){

                    // sleep para atender aos termos de uso:
                    // Intervalo entre requisições: o intervalo de término de uma requisição e início de outra deve ser de, no mínimo, um segundo.
                    sleep(1);

                    // get request para cada data de cada deputado
                    $responseDespesa = Http::get('https://dadosabertos.almg.gov.br/ws/prestacao_contas/verbas_indenizatorias/legislatura_atual/deputados/' . $deputado->id . '/' . $ano . '/' . $mes . '?formato=json')
                        ->json()["list"];

                    foreach ($responseDespesa as $despesa) {
                        if($despesa["idDeputado"]){
                            // para cada despesa do get, criamos uma despesa
                            foreach ($despesa['listaDetalheVerba'] as $subDespesa) {
                                App\Despesa::createDespesa($subDespesa);
                            }
                        }
                    }
                }
            }
        }
    }
}
