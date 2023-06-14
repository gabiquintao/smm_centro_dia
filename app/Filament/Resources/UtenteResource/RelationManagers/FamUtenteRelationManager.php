<?php

namespace App\Filament\Resources\UtenteResource\RelationManagers;

use App\Models\Utente;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Livewire;

class FamUtenteRelationManager extends RelationManager
{
    protected static string $relationship = 'famUtente';

    protected static ?string $modelLabel = "Familiar";

    protected static ?string $pluralModelLabel = "Familiares";

    protected static ?string $recordTitleAttribute = 'nome';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nome') ->required(),
                DatePicker::make('dt_nasc')->label('Data de Nascimento')->required(),
                Select::make('tipo_parentesco')->label('Parentesco')->required()
                    ->options(Utente::getParentescos()),
                Select::make('tipo_meio_vida')->label('Meio de Vida Principal')->required()
                    ->options([
                        0 => 'Reforma',
                        2 => 'Pensão Social',
                        3 => 'Pensão Mínima',
                        4 => 'Outro',
                    ]),
                TextInput::make('rendimento_mensal')->required()
                    ->label('Rendimento Mensal')
                    ->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ''))->required(),
                Toggle::make('is_vive_com')->required()
                    ->label('Vive com o utente?')
                    ->inline(false),
                Toggle::make('is_frequenta')->required()
                    ->label('Frequenta a instituição?')
                    ->inline(false)
            ]);
    }

    protected function getTableHeaderActions(): array
    {
        return [
            Tables\Actions\CreateAction::make()
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible()
            ])
            ->columns([
                Tables\Columns\TextColumn::make('nome'),
                Tables\Columns\TextColumn::make('created_at')->label('Criado a'),
                Tables\Columns\TextColumn::make('updated_at')->label('Atualizado a'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([

            ]);
    }
}
