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
        Schema::create('requerimient', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('catalogo_products');
            $table->foreignId('service_mantenimient_id')->constrained('service_mantenimient')->onDelete('cascade');
            $table->integer('cantidad');
            $table->string('especificaciones',300);
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
        Schema::dropIfExists('requerimient');
    }
};
