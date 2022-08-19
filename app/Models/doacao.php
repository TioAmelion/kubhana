<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class doacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'doador_id',
        'instituicao_id',
        'publicacao_id',
        'data', 
        'quantidade',
        'estado',
        'imagem'
    ];

    public function doador()
    {
        return $this->belongsTo(doador::class);
    }

    public function doacoes(){

        $query = DB::table("publicacaos")
                    ->select("publicacaos.*", 

                        DB::raw("(SELECT COUNT(classificacao_publicacaos.classificacao)
                        FROM classificacao_publicacaos 
                        WHERE classificacao_publicacaos.publicacao_id = publicacaos.id
                        GROUP BY classificacao_publicacaos.publicacao_id) as votos"),

                        DB::raw("(SELECT COUNT(s.id)
                        FROM solicitacaos s
                        WHERE s.publicacao_id = publicacaos.id
                        GROUP BY s.publicacao_id) as solicitacoes"),

                        DB::raw("(SELECT users.name FROM users WHERE users.id = publicacaos.user_id
                        GROUP BY users.name) as name"))
                        ->where('tipo_publicacao', 'doacao')
                        ->orderByDesc('id')
                        ->get();
        return $query;
    }
}
