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
        Schema::create('utente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nproc', 20)->nullable();
            $table->unsignedTinyInteger('estado')->default(0);
            $table->date('dt_inscricao')->nullable();
            $table->date('dt_admissao')->nullable();
            $table->date('dt_saida')->nullable();
            $table->string('nome')->nullable();
            $table->string('nome_trata')->nullable();
            $table->string('tlm')->nullable();
            $table->string('tlf')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('fam_responsavel_id')->nullable();
            $table->date('dt_nasc')->nullable();
            $table->unsignedTinyInteger('tipo_estado_civil')->default(0);
            $table->string('cc')->nullable();
            $table->string('nif', 9)->nullable();
            $table->string('ss', 12)->nullable();
            $table->string('num_utente', 12)->nullable();
            $table->unsignedBigInteger('sist_saude_id')->nullable();
            $table->dateTime('dh_validacao_utente')->nullable();
            $table->dateTime('dh_validacao_responsavel')->nullable();
            $table->dateTime('dh_validacao_coordenador')->nullable();
            $table->bigInteger('colaborador_id')->unsigned()->nullable();
            $table->timestamps();
            $table->text('obs')->nullable();
            $table->foreign('fam_responsavel_id')->references('id')->on('fam_responsavel')->onUpdate('CASCADE');;
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('sist_saude_id')->references('id')->on('sist_saude')->onUpdate('CASCADE');
            $table->foreign('colaborador_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utente');

        Schema::table('utente', function (Blueprint $table) {
            $table->dropForeign('fk_utente_fam_responsavel_id');
            $table->dropForeign('fk_utente_user_id');
            $table->dropForeign('fk_utente_sist_saude_id');
        });
    }
};
