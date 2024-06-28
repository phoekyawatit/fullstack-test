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
        Schema::create('property_geos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties')->cascadeOnDelete();
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->cascadeOnDelete();
            $table->unsignedBigInteger('province_id');
            $table->foreign('province_id')->references('id')->on('provinces')->cascadeOnDelete();
            $table->string('street')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_geos');
    }
};
