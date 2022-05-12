<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelurometrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telurometros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->string('tipo',50)->nullable();;
            $table->string('marca',50);
            $table->string('modelo',50);
            $table->string('serie',50)->nullable();;
            $table->date('fechacalib',20)->nullable();
            $table->integer('vigenciacalib')->unsigned();
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
        Schema::dropIfExists('telurometros');
    }
}
