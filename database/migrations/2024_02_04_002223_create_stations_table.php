<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('codestation')->nullable();
            $table->enum('tipoPy',['PACC','CPACC','Radio_HF'])->nullable();
            $table->string('latitud',25);
            $table->string('longitud',25);
            $table->string('altitud',10)->nullable();
            $table->integer('frec_canal')->nullable();
            $table->float('frec_fm',5,2)->nullable();            
            $table->enum('estado',['OPERATIVO','INOPERATIVO']);
            $table->enum('energia',['FOTOVOLTAICO','ELECTRICA','GENERADOR','OTRA','NO_TIENE']);
            $table->enum('caseta',['CONCRETO','ADOBE','MADERA'])->nullable();
            $table->enum('caseta_estado',['BUENO','REGULAR','MALO'])->nullable();
            $table->enum('situacion',['VERIFICADO','MANTENIMIENTO','INEXISTENTE','RETIRADO'])->nullable();
            $table->enum('siniestrado',['SI','NO'])->nullable();
            $table->enum('sistema',['VHF','HF']);
            $table->enum('tipo',['A','B','C']);
            $table->string('image_caseta')->nullable();
            $table->string('image_panoramica')->nullable();
            $table->string('image_torre')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->date('ultima_visita')->nullable();

            $table->foreignId('ubigeo_id')->constrained('ubigeos');

            $table->foreign('manager_id')->references('id')->on('station_manager');

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
        Schema::dropIfExists('stations');
    }
};
