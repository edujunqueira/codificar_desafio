<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    // propriedades para inserção no banco de dados
    protected $fillable = ['deputado_id', 'valor', 'data'];
    public $timestamps = false;

    // função para criação de uma despesa
    public static function createDespesa($desp)
    {
        $despesa = new Despesa();
        $despesa->deputado_id = $desp["idDeputado"];
        $despesa->valor = $desp["valor"];
        $despesa->data = $desp["dataReferencia"]["$"];

        // procurando o deputado que está referenciado por deputado_id, e linkando os dois objetos
        $deputado = Deputado::find($desp["idDeputado"]);
        $despesa->deputado()->associate($deputado);

        $despesa->save();
    }

    // função para retornar o deputado referenciado
    public function deputado()
    {
        return $this->belongsTo('App\Deputado');
    }
}
