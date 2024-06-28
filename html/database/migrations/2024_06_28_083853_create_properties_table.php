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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->boolean('for_sale')->default(true);
            $table->boolean('for_rent')->default(false);
            $table->boolean('sold')->default(false);
            $table->integer('price');
            $table->tinyInteger('property_type');
            $table->timestamps();
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('area');
            $table->tinyInteger('area_type');
            $table->index(['title', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
