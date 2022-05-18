<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provincia extends Model
{
    use HasFactory;

    public function pessoa()
    {
        return $this->hasMany(pessoa::class);
    }

    public function instituicao()
    {
        return $this->hasMany(instituicao::class);
    }
}
