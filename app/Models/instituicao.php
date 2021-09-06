<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instituicao extends Model
{
    use HasFactory;

    protected $guardad = ['id'];
    protected $fillable = [
        'user_id', 'pais_id', 'provincia_id', 'municipio_id', 'nome_instituicao', 'sigla', 'telefone', 'objectivo', 'nif'
    ];

    public function provincia()
    {
        return $this->hasOne(provincia::class);
    }
}
