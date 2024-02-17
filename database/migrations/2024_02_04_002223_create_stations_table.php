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
            $table->string('latitud',25);
            $table->string('longitud',25);
            $table->string('altitud',10)->nullable();
            $table->text('url_maps')->nullable();
            $table->integer('frec_canal')->nullable();
            $table->float('frec_fm',5,2)->nullable();
            $table->enum('energia',['FOTOVOLTAICO','ELECTRICA']);
            $table->enum('estado',['OPERATIVO','INOPERATIVO']);
            $table->enum('situacion',['VERIFICADO','MANTENIMIENTO','INEXISTENTE']);
            $table->enum('sistema',['VHF','HF']);
            $table->enum('tipo',['A','B','C']);
            $table->string('estation_image_path', 2048)->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->date('ultima_visita')->nullable();

            $table->foreignId('ubigeo_id')->constrained('ubigeo');

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
