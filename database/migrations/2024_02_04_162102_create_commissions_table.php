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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->string('comision');
            $table->string('slug');
            $table->integer('numero');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('periodo');
            $table->integer('year');
            $table->string('mes')->length(20);
            $table->enum('tipo',['MANTENIMIENTO','MEDICION','PROMOCION']);
            $table->enum('estado',['PENDIENTE','CONFIRMADO']);


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
        Schema::dropIfExists('commissions');
    }
};
