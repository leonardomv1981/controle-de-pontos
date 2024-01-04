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
        Schema::create('produtomilhas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_programa');
            $table->enum('operacao', ['credito', 'debito']);
            $table->integer('pontos_operacao');
            $table->integer('saldo_anterior')->nullable;
            $table->integer('saldo_atual');
            $table->decimal('valor_operacao', 10,2);
            $table->decimal('cpm_operacao', 10,2);
            $table->decimal('cpm_total', 10,2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtomilhas');
    }
};
