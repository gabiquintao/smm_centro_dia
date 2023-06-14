<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Utente;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Spatie\Permission\Models\Role;

class DashboardStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Utentes', Utente::all()->count()),
            Card::make('Utilizadores', User::all()->count()),
            Card::make('Colaboradores', Role::where('name', 'colaborador')->count()),
        ];
    }
}
