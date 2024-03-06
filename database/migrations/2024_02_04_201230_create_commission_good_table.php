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
        Schema::create('commission_good', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commission_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('good_id')->constrained('goods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commission_good');
    }
};
