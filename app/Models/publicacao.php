<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class publicacao extends Model
{
    use HasFactory;

    protected $guardad = ['id'];
    protected $fillable = ['usuario_id', 'titulo','categoria_id','texto'];

    public function show(){
        return DB::table('publicacaos')
                ->join('users', 'publicacaos.usuario_id', '=', 'users.id')
                ->select('users.name', 'publicacaos.*')->get();
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
