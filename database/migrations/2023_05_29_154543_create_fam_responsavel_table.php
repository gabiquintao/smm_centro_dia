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
        Schema::create('fam_responsavel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utente_id')->nullable();
            $table->string('nome')->nullable();
            $table->string('morada')->nullable();
            $table->string('cp1', 4)->nullable();
            $table->string('cp2', 3)->nullable();
            $table->string('localidade')->nullable();
            $table->string('tlm')->nullable();
            $table->string('tlf')->nullable();
            $table->string('email')->nullable();
            $table->date('dt_nasc')->nullable();
            $table->string('cc')->nullable();
            $table->string('nif', 9)->nullable();
            $table->string('ss', 12)->nullable();
            $table->text('obs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fam_responsavel');
    }
};
