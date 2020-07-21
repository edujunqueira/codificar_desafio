<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Http;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // pedimos a lista de deputados com as suas redes sociais
        $response = Http::get('http://dadosabertos.almg.gov.br/ws/deputados/lista_telefonica?formato=json');

        foreach ($response->json()["list"] as $dep) {
            // para cada deputado, vemos a lista de redes sociais

            foreach ($dep["redesSociais"] as $rede) {
                // para cada rede social, criamos uma social, passando também o id do deputado que ela está linkada
                App\Social::createSocial($rede["redeSocial"], $dep["id"]);
            }
        }
    }
}
