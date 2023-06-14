<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SistSaudeResource\Pages;
use App\Filament\Resources\SistSaudeResource\RelationManagers;
use App\Models\SistSaude;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SistSaudeResource extends Resource
{

    protected static function getNavigationGroup(): ?string
    {
        return "Administração";
    }

    protected static ?string $model = SistSaude::class;

    protected static ?string $modelLabel = "Subsistema de Saúde";

    protected static ?string $pluralModelLabel = "Subsistemas de Saúde";

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nome')
                    ->required()
                    ->string()
                    ->minLength(3)
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSistSaudes::route('/'),
        ];
    }
}
