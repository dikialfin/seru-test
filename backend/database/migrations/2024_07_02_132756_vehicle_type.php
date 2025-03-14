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
        Schema::create('vehicle_type', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('brand_id')->unsigned();
            $table->timestamps();
            $table->foreign('brand_id')->references('id')->on('vehicle_brand');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_type');
    }
};
