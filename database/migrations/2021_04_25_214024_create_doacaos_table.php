<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doacaos', function (Blueprint $table) {
            $table->id();

            $table->string('descricao');
            $table->integer('quantidade');
            $table->string('estado'); 
            $table->date('data')->nullable();
            $table->string('imagem')->nullable();
            $table->enum('confirmado', ['sim', 'nao'])->default('nao');

            $table->foreignId('doador_id')->constrained('doadors')->onDelete('cascade');
            $table->foreignId('instituicao_id')->constrained('instituicaos')->onDelete('cascade');
            $table->foreignId('publicacao_id')->constrained('publicacaos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doacaos');
    }
}
