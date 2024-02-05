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
        Schema::create('service_mantenimient', function (Blueprint $table) {
            $table->id();
            $table->enum('servicio',['DIAGNOSTICO','MANTENIMIENTO PREVENTIVO','MANTENIMIENTO CORRECTIVO']);
            $table->date('fechaServicio');
            $table->foreignId('station_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('service_mantenimient');
    }
};
