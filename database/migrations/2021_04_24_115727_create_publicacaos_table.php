<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacaosTable extends Migration
{
    public function up()
    {
        Schema::create('publicacaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');

            $table->string('titulo', 120);
            $table->string('estado_item', 50)->nullable();
            $table->string('quantidade_item')->nullable();
            $table->string('localizacao', 120)->nullable();
            $table->date('data_validade', 30)->nullable();
            $table->enum('estado_doacao', ['disponivel', 'indisponivel'])->nullable();
            $table->string('texto');
            $table->string('imagem')->nullable();
            $table->date('data')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('publicacaos');
    }
}
