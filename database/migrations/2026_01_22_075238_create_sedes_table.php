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
        Schema::create('sedes', function (Blueprint $table) {
            $table->id();
            $table->string('direccion', 150);
            $table->string('telefono', 20)->unique();
            $table->enum('ciudad', ["Tarragona", "Barcelona"])->default('Tarragona');
            $table->time('horario_apertura');
            $table->time('horario_cierre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sedes');
    }
};
