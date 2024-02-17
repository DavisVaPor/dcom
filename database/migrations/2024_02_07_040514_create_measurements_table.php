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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->string('ubicacion',100);
            $table->string('latitud',20);
            $table->string('longitud',20);
            $table->float('valor_rni',6,4,true);
            $table->date('fecha_medicion');
            $table->string('imagen');
            $table->foreignId('report_id')->constrained('reports')->onDelete('cascade');
            $table->foreignId('ubigeo_id')->constrained('ubigeo');

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
        Schema::dropIfExists('measurements');
    }
};
