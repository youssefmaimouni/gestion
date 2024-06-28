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
        Schema::create('vendres', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_sortie');
            $table->foreign('id_sortie')->references('id')->on('sorties')->onDelete('cascade');
        
            $table->unsignedBigInteger('id_mar');
            $table->foreign('id_mar')->references('id')->on('marchandises')->onDelete('cascade');

            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendres');
    }
};
