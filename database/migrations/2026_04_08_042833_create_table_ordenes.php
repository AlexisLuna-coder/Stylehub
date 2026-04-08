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
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
        
            // Relación con usuarios
            $table->foreignId('user_id')->constrained()
            ->onDelete('cascade')->onUpdate('cascade');

            $table->dateTime('fecha');
            $table->decimal('total', 10, 2);

            $table->enum('estado', [
                'Pendiente',
                'Pagado',
                'Enviado',
                'Entregado',
                'Cancelado'
            ])->default('Pendiente');

            $table->string('direccion_envio');
            $table->string('metodo_pago');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
