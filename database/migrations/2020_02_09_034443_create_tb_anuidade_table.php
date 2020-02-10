<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAnuidadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_anuidade', function (Blueprint $table) {
            $table->bigIncrements('anuidade_id');
            $table->string('nome');
            $table->string('numero');
            $table->string('ef');
            $table->string('data_debito');
            $table->string('valor_originario');
            $table->integer('valor_atualizado');
            $table->string('ativo');
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
        Schema::dropIfExists('tb_anuidade');
    }
}
