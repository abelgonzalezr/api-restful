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
        Schema::create('tblfactura', function (Blueprint $table) {
            $table->id('FacturaId');
            $table->unsignedBigInteger('PedidoId');
            $table->decimal('monto_total', 8, 2);
            $table->date('fecha_emision');
            $table->timestamps();

            $table->foreign('PedidoId')->references('PedidoId')->on('tblpedido')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblfactura');
    }
};
