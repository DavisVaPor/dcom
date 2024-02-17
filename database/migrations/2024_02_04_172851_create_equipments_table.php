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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->string('codPatrimonio')->length(12)->default('sin codigo');
            $table->string('denominacion');
            $table->string('detalle');
            $table->string('marca');
            $table->string('modelo');
            $table->string('serie');
            $table->string('color');
            $table->enum('operatividad',['OPERATIVO','INOPERATIVO']);
            $table->enum('estado',['BUENO','REGULAR','MALO']);
            $table->string('imagen')->nullable();
            $table->string('equipment_image_path', 2048)->nullable();
            $table->unsignedBigInteger('station_id')->nullable();

            $table->foreign('station_id')->references('id')->on('stations')->onDelete('set null');

            $table->foreignId('system_id')->constrained('system_equipament');
            $table->foreignId('category_id')->constrained('category');

            $table->enum('situacion',['ALTA','BAJA']);

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
        Schema::dropIfExists('equipments');
    }
};