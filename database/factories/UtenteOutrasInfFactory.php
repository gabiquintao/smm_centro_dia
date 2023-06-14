<?php

namespace Database\Factories;

use App\Models\UtenteOutrasInf;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UtenteOutrasInf>
 */
class UtenteOutrasInfFactory extends Factory
{
    protected $model = UtenteOutrasInf::class;

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
            'morada' => $faker->address,
            'cp1' => $faker->randomNumber(4),
            'cp2' => $faker->randomNumber(3),
            'localidade' => $faker->city,
            'is_proximo_na_instituicao' => $faker->boolean,
            'proximo_na_instituicao' => $faker->boolean,
            'naturalidade' => $faker->country,
            'tipo_habilitacoes' => $faker->randomElement(array_keys(UtenteOutrasInf::escolaridade())),
            'habilitacoes_desc' => $faker->sentence,
        ];
    }
}
