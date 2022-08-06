<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitacao extends Model
{
    use HasFactory;

    protected $guardad = ['id'];

    protected $fillable = [
        'user_id',
        'publicacao_id',
        'texto',
        'aceitar'
    ];
}
