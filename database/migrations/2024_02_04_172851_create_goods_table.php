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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('codPatrimonio')->length(12)->default('999999999999');
            $table->string('slug');
            $table->string('codigo_interno')->nullable();
            $table->string('denominacion');
            $table->enum('tipo',['SUMINISTRO','ACTIVO']);
            $table->integer('cantidad')->default(1);
            $table->string('marca');
            $table->string('modelo');
            $table->string('serie');
            $table->string('color');
            $table->enum('operatividad',['OPERATIVO','INOPERATIVO']);
            $table->enum('situacion',['INSTALADO','COMISION','ALMACEN']);
            $table->enum('condicion',['BUENO','REGULAR','MALO']);
            $table->string('imagen')->nullable();
            $table->enum('estado',['ALTA','BAJA']);

            $table->unsignedBigInteger('station_id')->nullable();
            $table->foreign('station_id')->references('id')->on('stations')->onDelete('set null');

            $table->foreignId('system_id')->constrained('systems');
            $table->foreignId('category_id')->constrained('categories');


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
        Schema::dropIfExists('goods');
    }
};
