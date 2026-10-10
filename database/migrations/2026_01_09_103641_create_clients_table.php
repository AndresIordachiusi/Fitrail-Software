<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('email', 100)->unique();
            $table->integer('edad')->unsigned()->nullable(); //unsigned para evitar edades negativas
            $table->integer('altura')->nullable(); // 3 digitos en total, 2 despues del punto decimal
            $table->decimal('peso', 5, 1)->nullable();
            $table->enum('objetivo', [
                'perder peso',
                'ganar masa muscular',
                'tonificar',
                'mantener forma',
                'aumentar resistencia',
                'mejorar flexibilidad',
                'recomposición corporal'
            ])->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
