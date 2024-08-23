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
        Schema::create('tblcompras', function (Blueprint $table) {
            $table->id('CompraId');
            $table->unsignedBigInteger('ClienteId');
            $table->unsignedBigInteger('ColocacionId');
            $table->integer('cantidad');
            $table->timestamps();

            $table->foreign('ClienteId')->references('ClienteId')->on('tblclientes')->onDelete('cascade');
            $table->foreign('ColocacionId')->references('ColocacionId')->on('tblcolocacion')->onDelete('cascade');

            $table->unique(['ClienteId', 'ColocacionId']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblcompras');
    }
};
