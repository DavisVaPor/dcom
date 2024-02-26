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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('ubicacion');
            $table->string('tema');
            $table->text('descripcion');
            $table->string('imagen_evidencia');
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
        Schema::dropIfExists('promotions');
    }
};
