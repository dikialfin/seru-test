<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pricelist', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->integer('price');
            $table->bigInteger('year_id')->unsigned();
            $table->bigInteger('model_id')->unsigned();
            $table->timestamps();
            $table->foreign('year_id')->references('id')->on('vehicle_year');
            $table->foreign('model_id')->references('id')->on('vehicle_model');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricelist');
    }
};
