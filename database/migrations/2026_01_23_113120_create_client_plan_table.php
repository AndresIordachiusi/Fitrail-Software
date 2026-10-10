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
        Schema::create('client_plan', function (Blueprint $table) {
            $table->foreignId("client_id")->constrained("clients")->cascadeOnDelete();
            $table->foreignId("plan_id")->constrained("plans")->cascadeOnDelete();
            $table->date("fecha_inicio")->nullable();
            $table->date("fecha_fin")->nullable();
            $table->enum("estado", ["Activo", "Desactivado"])->default("Activo");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_plan');
    }
};
