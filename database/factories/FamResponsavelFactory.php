<?php

namespace Database\Factories;

use App\Models\FamResponsavel;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FamResponsavel>
 */
class FamResponsavelFactory extends Factory
{
    protected $model = FamResponsavel::class;

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
            'nome' => $faker->name,
            'morada' => $faker->address,
            'cp1' => $faker->randomNumber(4),
            'cp2' => $faker->randomNumber(3),
            'localidade' => $faker->city,
            'tlm' => $faker->phoneNumber,
            'tlf' => $faker->phoneNumber,
            'email' => $faker->email,
            'dt_nasc' => $faker->dateTimeBetween('-90 years', '-18 years'),
            'cc' => $faker->randomNumber(8),
            'nif' => $faker->randomNumber(9),
            'ss' => $faker->randomNumber(9),
            'obs' => $faker->text,
        ];
    }
}
