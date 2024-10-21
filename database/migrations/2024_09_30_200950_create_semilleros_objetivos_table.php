<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('semilleros_objetivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('semillero_id');
            $table->text('objetivo_especifico');
            $table->timestamps();

            // Llave foránea a la tabla semilleros
            $table->foreign('semillero_id')->references('id')->on('semilleros')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semilleros_objetivos');
    }
};
