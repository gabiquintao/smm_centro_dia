<?php

namespace Database\Factories;

use App\Models\FamResponsavel;
use App\Models\User;
use App\Models\Utente;
use App\Models\UtenteOutrasInf;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Utente>
 */
class UtenteFactory extends Factory
{
    protected $model = Utente::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('pt_PT');

        return [
            'user_id' => User::pluck('id')->random(),
            'fam_responsavel_id' => FamResponsavel::pluck('id')->random(),
            'colaborador_id' => 1,
            'nproc' => Utente::gerarNumeroProcesso(),
            'estado' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8]),
            'dt_inscricao' => $faker->dateTimeBetween('-1 year', 'now'),
            'dt_admissao' => $faker->dateTimeBetween('-1 year', 'now'),
            'dt_saida' => $faker->dateTimeBetween('-1 year', 'now'),
            'nome' => $faker->name,
            'nome_trata' => $faker->name,
            'tlm' => $faker->phoneNumber,
            'tlf' => $faker->phoneNumber,
            'email' => $faker->email,
            'dt_nasc' => $faker->dateTimeBetween('-90 years', '-18 years'),
            'tipo_estado_civil' => $faker->randomElement([1, 2, 3, 4, 5]),
            'cc' => $faker->randomNumber(8),
            'nif' => $faker->randomNumber(9),
            'ss' => $faker->randomNumber(9),
            'num_utente' => $faker->randomNumber(8),
            'sist_saude_id' => $faker->randomElement([1, 2, 3, 4, 5]),
            'obs' => $faker->text,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {

        return $this->afterCreating(function (Utente $utente) {

            $faker = FakerFactory::create('pt_PT');

            $utente->infOutras()->create([
                'morada' => $faker->address,
                'cp1' => $faker->randomNumber(4),
                'cp2' => $faker->randomNumber(3),
                'localidade' => $faker->city,
                'is_proximo_na_instituicao' => $faker->boolean,
                'proximo_na_instituicao' => $faker->boolean,
                'naturalidade' => $faker->country,
                'tipo_habilitacoes' => $faker->randomElement(array_keys(UtenteOutrasInf::escolaridade())),
                'habilitacoes_desc' => $faker->sentence,
            ]);

            $utente->infEconomica()->create([
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
            ]);

            $utente->suporte()->create([
            ]);

            $utente->famResponsavel()->create([
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
            ]);
        });
    }
}
