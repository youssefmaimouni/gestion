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
        Schema::create('marchandises', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->longText('description')->nullable();
            $table->integer('quantite')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('id_cat')->nullable();
            $table->foreign('id_cat')->references('id')->on('categories')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marchandises');
    }
};
