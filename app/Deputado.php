<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Deputado extends Model
{
    // propriedades para inserção no banco de dados
    protected $fillable = ['id', 'nome', 'partido'];
    public $timestamps = false;

    // função para criação de um deputado
    public static function createDeputado($dep)
    {
        $deputado = new Deputado();

        $deputado->id = $dep["id"];
        $deputado->nome = $dep["nome"];
        $deputado->partido = $dep["partido"];

        $deputado->save();
    }

    // função para retornar os 5 deputados com maior média de gastos em 2019
    public static function gastadoresAnual()
    {
        // fazemos um query para retornar a soma de um mês especifico de cada deputado
        $somaMeses = DB::table('deputados')
            ->join('despesas', 'despesas.deputado_id', '=', 'deputados.id')
            ->select(DB::raw("MONTH(data) as mes"), 'deputados.nome as nome', DB::raw("CAST(SUM(despesas.valor) AS DECIMAL(16, 2)) as valor"))
            ->groupBy('nome', 'mes')
            ->orderBy('valor', 'DESC')->toSql();

        // usando o query acima, pegamos então a media de cada deputado, no mês determinado
        // e retornamos o query
        return Deputado::retGastadores($somaMeses);
    }

    // função para retornar os 5 deputados com maior média de gastos por mês em 2019
    public static function gastadores($mes)
    {
        // fazemos um query para retornar a soma de cada mês de cada deputado
        $somaMeses = DB::table('deputados')
            ->join('despesas', 'despesas.deputado_id', '=', 'deputados.id')
            ->select(DB::raw("MONTH(data) as mes"), 'deputados.nome as nome', DB::raw("CAST(SUM(despesas.valor) AS DECIMAL(16, 2)) as valor"))
            ->groupBy('nome', 'mes')
            ->where(DB::raw("MONTH(data)"), '=', DB::raw("(${mes})"))
            ->orderBy('valor', 'DESC')->toSql();

        // usando o query acima, pegamos então a media de cada deputado, no ano de 2019
        // e retornamos o query
        return Deputado::retGastadores($somaMeses);
    }

    // função de retorno (economizar código)
    public static function retGastadores($somaMeses)
    {
        return DB::table(DB::raw("(${somaMeses}) as tab"))
            ->select('tab.nome', DB::raw('CAST(AVG(tab.valor) AS DECIMAL(16, 2)) as gasto'))
            ->groupBy('tab.nome')
            ->orderBy('gasto', 'DESC')
            ->offset(0)->limit(5)
            ->get();
    }

    // funções para retornar os filhos
    public function despesas()
    {
        return $this->hasMany('App\Despesa');
    }
    public function socials()
    {
        return $this->hasMany('App\Social');
    }
}
