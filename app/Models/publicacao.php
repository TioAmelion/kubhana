<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Classificacao_publicacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class publicacao extends Model
{
    use HasFactory;

    protected $guardad = ['id'];

    protected $fillable = [
        'user_id',
        'titulo',
        'categoria_id',
        'texto',
        'estado_item',
        'quantidade_item',
        'localizacao',
        'data_validade',
        'imagem',
        'data',
        'tipo_publicacao',
        'estado_doacao'
    ];

    public function show(){

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

                        DB::raw("(SELECT COUNT(d.id)
                        FROM doacaos d
                        WHERE d.publicacao_id = publicacaos.id
                        GROUP BY d.publicacao_id) as doacoes"),

                        DB::raw("(SELECT users.name FROM users WHERE users.id = publicacaos.user_id
                        GROUP BY users.name) as name"))
                        ->orderByDesc('id')
                        ->get();
        return $query;
    }

    public function showProfile(){

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

                    DB::raw("(SELECT COUNT(d.id)
                    FROM doacaos d
                    WHERE d.publicacao_id = publicacaos.id
                    GROUP BY d.publicacao_id) as doacoes"),

                    DB::raw("(SELECT users.name FROM users WHERE users.id = publicacaos.user_id
                    GROUP BY users.name) as name"))
                        ->where('user_id', Auth::user()->id)
                        ->orderByDesc('id')
                        ->get();
        return $query;
    }

    public function listarAjudas($id) {
        return DB::select("SELECT us.name FROM doacaos doac, instituicaos inst, users us WHERE doac.instituicao_id = us.id AND us.id = inst.user_id  AND doac.doador_id = $id ");
    }

    public function doacoesSemana() {
        $doacoes = DB::select('SELECT * FROM doacaos d, users u, pessoas p, doadors do 
        WHERE u.id = p.user_id 
        AND p.id = do.pessoa_id
        AND do.id = d.doador_id
        AND WEEK(d.data) = WEEK(NOW())');
        return $doacoes;
    }

    public function instSemAjudas() {
        $ajudas = DB::select('SELECT * FROM instituicaos as i WHERE  NOT EXISTS (SELECT d.id FROM doacaos as d WHERE d.instituicao_id = i.id )');
        return $ajudas;
    }

    public function estadoPessoa() {
        return DB::table('publicacaos')
                ->join('categorias', 'publicacaos.categoria_id', '=', 'categorias.id')
                ->select('publicacaos.titulo', 'publicacaos.texto')->where('nome_categoria', 'Pessoa em Estado Critico')->get();
    }

    public function categorias() {
        return $this->hasOne(Categoria::class);
    }

    public function classiPublicacao() {
        return $this->hasMany(Classificacao_publicacao::class);
    }

    public function user() {
        return $this->belongsTo(Classificacao_publicacao::class);
    }
}
