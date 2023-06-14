<?php

namespace App\Filament\Resources\UtenteResource\Pages;

use App\Filament\Resources\UtenteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUtentes extends ListRecords
{
    protected static string $resource = UtenteResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            UtenteResource\Widgets\StatsOverview::class
        ];
    }
}
