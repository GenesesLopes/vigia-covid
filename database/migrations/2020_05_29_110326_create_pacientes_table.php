<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('nome_mae');
            $table->date('data_nascimento');
            $table->string('sexo',45);
            $table->string('logradouro');
            $table->string('numero',10)->nullable();
            $table->string('bairro');
            $table->string('cidade');
            $table->string('telefone',45)->nullable();
            $table->boolean('pr_saude')->default(false);
            $table->unsignedBigInteger('user_create');
            $table->foreign('user_create')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('pacientes');
    }
}
