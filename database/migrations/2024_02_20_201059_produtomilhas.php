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
            $table->foreignId('id_programa')->constrained('programas');
            $table->foreignId('id_usuario')->constrained('users');
            $table->enum('operacao', ['credito', 'debito']);
            $table->date('data_operacao');
            $table->integer('pontos_operacao');
            $table->decimal('valor_operacao', 10,2);
            $table->decimal('cpm_operacao', 10,2);
            $table->decimal('cpm_acumulado', 10,2);
            $table->enum('situacao', ['ATIVO', 'EXCLUIDO']);
            $table->string('observacao', 255)->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
