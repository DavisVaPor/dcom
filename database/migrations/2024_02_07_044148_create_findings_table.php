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
        Schema::create('findings', function (Blueprint $table) {
            $table->id();
            $table->date('fechaConstatacion');
            $table->enum('Radiodifusion',['FM','TV']);
            $table->foreignId('ubigeo_id')->constrained('ubigeo');
            $table->string('ubicacion');
            $table->string('caracteristicas');
            $table->string('imagen');
            $table->string('observaciones')->nullable();

            $table->foreignId('report_id')->constrained('reports')->onDelete('cascade');
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
        Schema::dropIfExists('findings');
    }
};
