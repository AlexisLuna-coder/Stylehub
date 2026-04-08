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
        Schema::create('detalle_orden', function (Blueprint $table) {
            $table->id();
            // Relación con orden
            $table->foreignId('orden_id')->constrained('ordenes')
            ->onDelete('cascade')->onUpdate('cascade');

            // Relación con producto
            $table->foreignId('producto_id')->constrained('productos')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_orden');
    }
};
