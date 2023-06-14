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
        Schema::create('utente_inf_economica', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utente_id')->nullable();
            $table->unsignedDecimal('rendimento_trabalho', 7)->default(0);
            $table->unsignedDecimal('reforma', 7)->default(0);
            $table->unsignedDecimal('pensao', 7)->default(0);
            $table->unsignedDecimal('complemento_dep', 7)->default(0);
            $table->unsignedDecimal('outro_rendimento', 7)->default(0);
            $table->unsignedDecimal('medicacao', 7)->default(0);
            $table->unsignedDecimal('renda', 7)->default(0);
            $table->unsignedDecimal('agua', 7)->default(0);
            $table->unsignedDecimal('gaz', 7)->default(0);
            $table->unsignedDecimal('energia', 7)->default(0);
            $table->unsignedDecimal('telefone', 7)->default(0);
            $table->unsignedDecimal('alimentacao', 7)->default(0);
            $table->unsignedDecimal('outra_despesa', 7)->default(0);
            $table->timestamps();
            $table->foreign(['utente_id'], 'fk_utente_inf_economica_utente_id')->references(['id'])->on('utente')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('utente_inf_economica', function (Blueprint $table) {
            $table->dropForeign('fk_utente_inf_economica_utente_id');
        });

        Schema::dropIfExists('utente_inf_economica');
    }
};
