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
        Schema::create('entres', function (Blueprint $table) {
            $table->id();

            $table->date('date_doc');

            $table->unsignedBigInteger('id_four')->nullable();
            $table->foreign('id_four')->references('id')->on('fournisseurs')->onDelete('set null');

            $table->unsignedBigInteger('id_cat')->nullable();
            $table->foreign('id_cat')->references('id')->on('categories')->onDelete('set null');

            $table->string('attachement')->nullable();

            $table->text('description')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entres');
    }
};
