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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->float('montant');
            $table->string('nom');
            $table->unsignedBigInteger('id_cat');
            $table->foreign('id_cat')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('id_magasin');
            $table->foreign('id_magasin')->references('id')->on('magazins')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
