<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');

            $table->string('titulo', 50);
            $table->string('estado_item', 50)->nullable();
            $table->string('quantidade_item', 50)->nullable();
            $table->string('localizacao', 50)->nullable();
            $table->date('data_validade', 50)->nullable();
            $table->string('texto');
            $table->string('imagem')->nullable();
            $table->date('data')->nullable();
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
        Schema::dropIfExists('publicacaos');
    }
}
