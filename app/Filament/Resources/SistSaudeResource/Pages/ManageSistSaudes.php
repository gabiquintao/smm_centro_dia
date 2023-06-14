<?php

namespace App\Filament\Resources\SistSaudeResource\Pages;

use App\Filament\Resources\SistSaudeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSistSaudes extends ManageRecords
{
    protected static string $resource = SistSaudeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
