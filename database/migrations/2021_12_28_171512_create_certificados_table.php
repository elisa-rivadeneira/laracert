<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();
            $table->string('cliente',255);
            $table->string('departamento',255);
            $table->string('provincia',255);
            $table->string('distrito',255);
            $table->string('agencia',255)->nullable();;
            $table->string('direccion',255);
            $table->biginteger('firma')->unsigned();
            $table->biginteger('telurometro')->unsigned();
            $table->string('qr',255);
            $table->string('pozoubicacion',255);
            $table->string('tipopozo',255);
            $table->string('conectadotablero',255);
            $table->string('otraopcionconectadotablero',255)->nullable();
            $table->string('taparegistro',255);
            $table->string('otraopciontaparegistro',255)->nullable();
            $table->string('electrodomaterial',255);
            $table->string('electrododiametro',255);
            $table->string('cajatipo',255);
            $table->string('cajaestado',255);
            $table->string('cajaobservacion',255);
            $table->string('conectortipo',255);
            $table->string('conectorestado',255);
            $table->string('conectorobservacion',255);
            $table->string('cabletipo',255);
            $table->string('cablediametro',255);
            $table->string('obsadicional',255)->nullable();
            $table->string('metodomedicion',255);
            $table->string('resistenciapozo',255);
            $table->string('longitudelectrodo',255);
            $table->time('vihora')->nullable();;
            $table->date('vifecha',20)->nullable();
            $table->string('vimedicion',255)->nullable();
            $table->time('vfhora')->nullable();
            $table->date('vffecha',20)->nullable();
            $table->string('vfmedicion',255)->nullable();
            $table->integer('nropozo')->unsigned();
            $table->integer('vigenciamedicion')->unsigned();
            $table->date('fechamedicion',20);
            $table->string('distanciapicau',255);
            $table->string('distanciapicad',255);
            $table->string('fotocertif')->nullable();
            $table->timestamps();
            $table->foreign('firma')->references('id')->on('firmas')->onDelete('cascade');;
            $table->foreign('telurometro')->references('id')->on('telurometros');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificados');
    }
}
