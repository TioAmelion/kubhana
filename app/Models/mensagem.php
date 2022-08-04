<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mensagem extends Model
{
    use HasFactory;

    protected $guardad = ['id'];

    protected $fillable = [
        'de',
        'para',
        'texto',
        'imagem'
    ];
}
