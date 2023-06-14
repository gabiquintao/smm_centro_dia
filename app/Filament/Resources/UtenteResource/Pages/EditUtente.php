<?php

namespace App\Filament\Resources\UtenteResource\Pages;

use App\Filament\Resources\UtenteResource;
use App\Models\User;
use App\Models\Utente;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Spatie\Permission\Models\Role;

class EditUtente extends EditRecord
{
    protected static string $resource = UtenteResource::class;

    protected function getSubheading(): string|Htmlable|null
    {
        $estado = $this->record->estado;

        if (is_numeric($estado) && array_key_exists($estado, Utente::getEstados())) {
            return Utente::getEstados()[$estado];
        }

        return $estado;
    }

    protected function getTitle(): string
    {
        return $this->record->nome;
    }

    protected function getActions(): array
    {
        return [
            Action::make('Atribuir colaborador')
                ->visible(fn () => auth()->user()->hasRole(['super_admin', 'coordenador']) && $this->record->estado == 2)
                ->mountUsing(fn (Forms\ComponentContainer $form) => $form->fill([
                    'colaborador_id' => $this->record->colaborador_id,
                ]))
                ->action(function (array $data): void {
                    $this->record->colaborador_id = $data['colaborador_id'];
                    $this->record->save();
                })
                ->form([
                    Select::make('colaborador_id')
                        ->label('Colaborador')
                        ->options(User::role('colaborador')->pluck('name', 'id'))
                        ->searchable()
                        ->required(),
                    Checkbox::make('Confirmo esta ação')->required()
                ]),
            Action::make('Verificar')
                ->visible(fn () => auth()->user()->hasRole('super_admin') || $this->record->estado == 2)
                ->requiresConfirmation()
                ->modalHeading('Verificar Utente')
                ->modalSubheading('Pretende verificar este utente?')
                ->form([
                    Checkbox::make('Confirmo esta ação')->required()
                ])
                ->action(function (array $data): void {
                    $this->record->estado = 3;
                    $this->record->save();
                }),

            Action::make('Desaprovar')
                ->visible(fn () => auth()->user()->hasRole('super_admin') || $this->record->estado == 2)
                ->requiresConfirmation()
                ->modalHeading('Desaprovar Utente')
                ->modalSubheading('Por questões de falhas significativas no formulário, tem a opção de interromper este processo.')
                ->form([
                    Checkbox::make('Confirmo esta ação')->required()
                ])
                ->action(function (array $data): void {
                    $this->record->estado = 6;
                    $this->record->save();
                }),
            Action::make('Gerir')
                ->visible(fn () => auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('coordenador') && $this->record->estado == 3)
                ->mountUsing(fn (Forms\ComponentContainer $form) => $form->fill([
                    'estado' => $this->record->estado,
                ]))
                ->action(function (array $data): void {
                    $this->record->estado = $data['estado'];
                    $this->record->save();
                })
                ->form([
                    Select::make('estado')
                        ->label('Estado')
                        ->options(Utente::getEstados()),
                    Fieldset::make('Admissibilidade')
                        ->relationship('admissibilidade')
                        ->schema([
                            Toggle::make('is_entregues_docs_necessarios')
                                ->label('Foram entregues cópias de todos os documentos necessários?')
                                ->helperText('Nota: a não apresentação dos documentos necessários para o cálculo da mensalidade, determinará o pagamentoda mensalidade máxima, até á entrega dos mesmos, não havendo lugar a posteriores reembolsos. '),
                            Checkbox::make('is_admissibilidade_1')
                                ->label('Ser Pensionista e/ou Reformado com idade igual ou superior à idade de reforma em vigor, salvo casos excecionaisa considerar pela Direção'),
                            Checkbox::make('is_admissibilidade_2')
                                ->label('Não sofrer de doença que prejudique o regular funcionamento da resposta social;'),
                            Checkbox::make('is_admissibilidade_3')
                                ->label('Não se encontrar em situação de necessitar de cuidados médicos e de enfermagem especiais ou de outro pessoal especializado;'),
                            Radio::make('tipo_admissivel')
                                ->label('O utente é admissível e existe vaga?')
                                ->options([
                                    1 => 'Sim, é admissível e existe vaga',
                                    2 => 'Sim, é admissível mas não existe vaga',
                                    3 => 'Não é admissível'
                                ])
                                ->helperText('Nota: se o utente não é admissível informa-se o utente e arquiva-se a candidatura.'),
                        ])->columns(1)
                ]),
            DeleteAction::make()
                ->visible(fn () => auth()->user()->hasRole('super_admin')),
        ];
    }
}
