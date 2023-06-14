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
        Schema::create('utente_admissibilidade', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utente_id')->nullable();
            $table->unsignedTinyInteger('is_entregues_docs_necessarios')->default(0);
            $table->unsignedTinyInteger('is_admissibilidade_1')->default(0);
            $table->unsignedTinyInteger('is_admissibilidade_2')->default(0);
            $table->unsignedTinyInteger('is_admissibilidade_3')->default(0);
            $table->unsignedTinyInteger('tipo_admissivel')->default(0);
            $table->text('razao_nao_admissivel')->nullable();
            $table->unsignedBigInteger('preenchido_por_colaborador_id')->nullable();
            $table->timestamps();
            $table->foreign(['utente_id'])->references(['id'])->on('utente')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utente_admissibilidade');
    }
};
