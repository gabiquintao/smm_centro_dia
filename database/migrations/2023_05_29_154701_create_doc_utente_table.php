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
        Schema::create('doc_utente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utente_id')->nullable()->index();
            $table->foreign('utente_id')
                ->references('id')
                ->on('utente')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('dt_recebido')->nullable();
            $table->string('nome_doc')->nullable();
            $table->string('local_fich')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doc_utente', function (Blueprint $table) {
            $table->dropForeign('fk_doc_utente_colaborador_id');
            $table->dropForeign('fk_doc_utente_utente_id');
        });

        Schema::dropIfExists('doc_utente');
    }
};
