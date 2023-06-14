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
        Schema::create('utente_suporte', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utente_id')->nullable()->index('utente_suporte_utente_id_fk');
            $table->unsignedTinyInteger('is_necessita_suporte')->default(0);
            $table->unsignedTinyInteger('tipo_suporte_existente')->default(0);
            $table->unsignedTinyInteger('tipo_grau_dependencia')->default(0);
            $table->unsignedTinyInteger('is_deficiencia_mental')->default(0);
            $table->unsignedTinyInteger('is_deficiencia_visual')->default(0);
            $table->unsignedTinyInteger('is_deficiencia_motora')->default(0);
            $table->unsignedTinyInteger('is_deficiencia_auditiva')->default(0);
            $table->text('motivo_pedido')->nullable();
            $table->timestamps();
            $table->foreign(['utente_id'])->references(['id'])->on('utente')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('utente_suporte', function (Blueprint $table) {
            $table->dropForeign('fk_utente_suporte_utente_id');
        });

        Schema::dropIfExists('utente_suporte');
    }
};
