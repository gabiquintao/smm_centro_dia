<?php

namespace App\Filament\Resources\UtenteResource\Widgets;

use App\Models\Utente;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Utentes', Utente::all()->count()),
            Card::make('Aprovados', Utente::all()->where('estado', 4)->count()),
            Card::make('Lista de Espera', Utente::all()->where('estado', 5)->count()),
        ];
    }
}
