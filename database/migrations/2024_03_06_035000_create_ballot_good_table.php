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
        Schema::create('ballot_good', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ballot_id')->constrained('ballots')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('good_id')->constrained('goods')->onDelete('cascade');

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
        Schema::dropIfExists('ballot_good');
    }
};
