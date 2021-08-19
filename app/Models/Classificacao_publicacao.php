<?php

namespace App\Models;
use App\Models\publicacao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classificacao_publicacao extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'user_id',
        'publicacao_id', 
        'classificacao'
    ]; 

    public function publicacao() {
        return $this->belongsTo(publicacao::class);
    }
}
