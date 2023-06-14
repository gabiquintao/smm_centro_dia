<?php

namespace Database\Factories;

use App\Models\UtenteInfEconom;
use App\Models\UtenteInfEconomica;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UtenteInfEconom>
 */
class UtenteInfEconomicaFactory extends Factory
{
    protected $model = UtenteInfEconomica::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('pt_PT');

        return [
            'utente_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8]),
            'rendimento_trabalho' => $faker->randomFloat(2, 0, 1000),
            'reforma' => $faker->randomFloat(2, 0, 1000),
            'pensao' => $faker->randomFloat(2, 0, 1000),
            'complemento_dep' => $faker->randomFloat(2, 0, 1000),
            'outro_rendimento' => $faker->randomFloat(2, 0, 1000),
            'medicacao' => $faker->randomFloat(2, 0, 1000),
            'renda' => $faker->randomFloat(2, 0, 1000),
            'agua' => $faker->randomFloat(2, 0, 1000),
            'gaz' => $faker->randomFloat(2, 0, 1000),
            'energia' => $faker->randomFloat(2, 0, 1000),
            'telefone' => $faker->randomFloat(2, 0, 1000),
            'alimentacao' => $faker->randomFloat(2, 0, 1000),
            'outra_despesa' => $faker->randomFloat(2, 0, 1000),
        ];
    }
}
