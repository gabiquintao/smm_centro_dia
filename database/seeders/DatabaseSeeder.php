<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\FamResponsavel;
use App\Models\SistSaude;
use App\Models\User;
use App\Models\Utente;
use App\Models\UtenteInfEconomica;
use App\Models\UtenteOutrasInf;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        FamResponsavel::factory(8)->create();

        SistSaude::create(['nome' => 'SNS']);
        SistSaude::create(['nome' => 'ADSE']);
        SistSaude::create(['nome' => 'ADM']);
        SistSaude::create(['nome' => 'SAD-PSP']);
        SistSaude::create(['nome' => 'SAD-GNR']);

        Utente::factory(8)->create();
    }
}
