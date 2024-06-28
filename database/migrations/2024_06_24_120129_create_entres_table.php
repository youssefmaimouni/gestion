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

            $table->unsignedBigInteger('id_four');
            $table->foreign('id_four')->references('id')->on('fournisseurs')->onDelete('cascade');

            $table->string('attachement');

            $table->text('descreption');
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
