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
        Schema::create('criptomoneda_moneda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criptomoneda_id')->constrained('criptomonedas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('moneda_id')->constrained('monedas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('precio', 20, 8)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criptomoneda_moneda');
    }
};
