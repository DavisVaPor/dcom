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
        Schema::create('movimients', function (Blueprint $table) {
            $table->id();
            $table->date('fechamovimiento');
            $table->enum('tipo',['INSTALACION','RETIRO']);
            $table->foreignId('service_mantenimient_id')->constrained('service_mantenimient')->onDelete('cascade');
            $table->foreignId('equipment_id')->constrained('equipments');
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
        Schema::dropIfExists('movimients');
    }
};
