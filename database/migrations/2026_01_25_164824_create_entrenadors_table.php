<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void //up() se utiliza para definir las operaciones de migración
    {
        Schema::create('entrenadors', function (Blueprint $table) {
            $table->id();
            $table->string("nombre", 100);
            $table->string("apellido", 100);
            $table->string("email", 100)->unique();
            $table->integer("telefono");
            $table->string("direccion", 150);
            $table->enum("especialidad", [
                'Musculación',
                'CrossFit',
                'Funcional',
                'Yoga',
                'Rehabilitación'
            ]);
            $table->foreignId("sede_id")->constrained("sedes")->cascadeOnDelete();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrenadors');
    }
};
