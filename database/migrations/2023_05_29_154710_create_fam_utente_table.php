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
        Schema::create('fam_utente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utente_id')->nullable()->index('fam_utente_utente_id_fk');
            $table->string('nome')->nullable();
            $table->date('dt_nasc')->nullable();
            $table->unsignedTinyInteger('tipo_parentesco')->default(0);
            $table->unsignedTinyInteger('is_vive_com')->default(1);
            $table->unsignedTinyInteger('is_frequenta')->default(1);
            $table->unsignedTinyInteger('tipo_meio_vida')->default(0);
            $table->unsignedDecimal('rendimento_mensal', 7)->default(0);
            $table->timestamps();
            $table->foreign(['utente_id'], 'fk_fam_utente_utente_id')->references(['id'])->on('utente')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fam_utente', function (Blueprint $table) {
            $table->dropForeign('fk_fam_utente_utente_id');
        });

        Schema::dropIfExists('fam_utente');
    }
};
