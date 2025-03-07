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
        Schema::create('vehicle_model', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('type_id')->unsigned();
            $table->timestamps();
            $table->foreign('type_id')->references('id')->on('vehicle_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_model');
    }
};
