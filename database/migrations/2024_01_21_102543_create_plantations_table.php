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
        Schema::create('plantations', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('specie_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('location_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('collection_date');
            $table->string('latitude');
            $table->integer('no_accessions');
            $table->string('longitude');
            // $table->string('method');
            $table->date('planted_at');
            $table->integer('seeds');
            $table->integer('seedlings');
            $table->integer('wildlings');
            $table->integer('cuttings');
            $table->integer('marcotted');
            $table->integer('plantation_site');
            $table->string('code');
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
        Schema::dropIfExists('plantations');
    }
};