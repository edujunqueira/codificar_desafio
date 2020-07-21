<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Social extends Model
{
    // propriedades para inserção no banco de dados
    protected $fillable = ['nome'];
    public $timestamps = false;

    // função para criação de uma rede social
    public static function createSocial($rede, $depId)
    {
        $redeSocial = new Social();
        $redeSocial->nome = $rede['nome'];
        $redeSocial->deputado_id = $depId;

        // procurando o deputado que está referenciado por deputado_id, e linkando os dois objetos
        $deputado = Deputado::find($depId);
        $redeSocial->deputado()->associate($deputado);

        $redeSocial->save();
    }

    // função para retornar as redes sociais mais usadas pelos deputados
    public static function redesMaisUsadas()
    {
        // retornamos o query
        return DB::table('socials')
            ->select('socials.nome', DB::raw("COUNT(socials.nome) as usuarios"))
            ->groupBy('socials.nome')
            ->orderBy('usuarios', 'DESC')
            ->get();
    }

    // função para retornar o deputado referenciado
    public function deputado()
    {
        return $this->belongsTo('App\Deputado');
    }
}
