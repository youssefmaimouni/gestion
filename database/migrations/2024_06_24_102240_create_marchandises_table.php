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
            $table->integer('barre_code');
            $table->string('description')->nullable();
            $table->integer('quantite');
            $table->string('unite');
            $table->string('image');
            $table->unsignedBigInteger('id_cat');
            $table->foreign('id_cat')->references('id')->on('categories')->onDelete('cascade');
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
