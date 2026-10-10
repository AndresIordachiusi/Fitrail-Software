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
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('entrenador_id')->nullable()->constrained('entrenadors')->nullOnDelete();
            $table->date('fecha_seguimiento');
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('altura', 3, 2)->nullable();
            $table->decimal('imc', 5, 2)->nullable();
            $table->unsignedTinyInteger('nivel_energia');
            $table->unsignedTinyInteger('adherencia');
            $table->enum('progreso', ['sin_cambios', 'mejorando', 'retroceso']);
            $table->text('observaciones')->nullable();
            $table->text('proximos_pasos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimientos');
    }
};
