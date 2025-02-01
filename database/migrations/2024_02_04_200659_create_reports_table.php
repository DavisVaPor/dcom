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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->string('slug');
            $table->integer('anho');
            $table->string('asunto',150);
            $table->date('fechaCreacion');
            $table->enum('estado',['BORRADOR','PRESENTADO']);

            $table->foreignId('commission_id')->constrained('commissions')->onDelete('cascade')

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
        Schema::dropIfExists('reports');
    }
};
