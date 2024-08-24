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
        Schema::create('tblpedido', function (Blueprint $table) {
            $table->id('PedidoId');
            $table->unsignedBigInteger('ClienteId');
            $table->date('fecha');
            $table->timestamps();

            $table->foreign('ClienteId')->references('ClienteId')->on('tblclientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblpedido');
    }
};
