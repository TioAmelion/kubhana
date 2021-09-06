<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pessoa extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'pais_id',
        'provincia_id',
        'municipio_id',
        'nome_pessoa',
        'telefone',
        'data_nascimento',
        'genero',
        'numero_identificacao'
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doador()
    {
        return $this->hasOne(doador::class);
    }

    public function provincia()
    {
        return $this->hasOne(provincia::class);
    }
}
