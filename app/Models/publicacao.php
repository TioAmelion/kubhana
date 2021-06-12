<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use DB;

class publicacao extends Model
{
    use HasFactory;

    protected $guardad = ['id'];
    protected $fillable = ['usuario_id', 'titulo','categoria_id','texto', 'estado_item', 'quantidade_item', 'localizacao', 'data_validade', 'image'];

    public function show(){
        $query = DB::table('publicacaos')
                ->join('users', 'publicacaos.usuario_id', '=', 'users.id')
                ->select('users.name', 'publicacaos.*')->orderByDesc('id')->get();
        
        return $query;
    }

    public function doacoesSemana() {
        $doacoes = DB::select('SELECT * FROM doacaos WHERE WEEK(data, 1) = WEEK(NOW())');
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
}
