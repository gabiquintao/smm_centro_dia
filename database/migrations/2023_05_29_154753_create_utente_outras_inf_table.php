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
        Schema::create('utente_outras_inf', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utente_id')->nullable();
            $table->string('morada')->nullable();
            $table->string('cp1', 4)->nullable();
            $table->string('cp2', 3)->nullable();
            $table->string('localidade')->nullable();
            $table->unsignedTinyInteger('is_proximo_na_instituicao')->default(0);
            $table->string('proximo_na_instituicao')->nullable();
            $table->unsignedTinyInteger('tipo_visita')->default(0);
            $table->date('dt_visita')->nullable();
            $table->string('naturalidade')->nullable();
            $table->unsignedTinyInteger('tipo_habilitacoes')->default(0);
            $table->string('habilitacoes_desc')->nullable();
            $table->timestamps();
            $table->foreign(['utente_id'])->references(['id'])->on('utente')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('utente_outras_inf', function (Blueprint $table) {
            $table->dropForeign('fk_utente_outras_inf_utente_id');
        });

        Schema::dropIfExists('utente_outras_inf');
    }
};
