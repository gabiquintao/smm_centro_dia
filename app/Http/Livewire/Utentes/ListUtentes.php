<?php

namespace App\Http\Livewire\Utentes;

use App\Models\Utente;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListUtentes extends Component implements HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Utente::where('user_id', Auth::id());
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('nome'),
            BadgeColumn::make('estado')
                ->enum(Utente::getEstados())
                ->colors([
                    'secondary' => 1,
                ]),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ViewAction::make()
                ->url(fn(Utente $record): string => route('utentes.show', $record)),
            Tables\Actions\EditAction::make()
                ->url(fn(Utente $record): string => route('utentes.edit', $record))
                ->visible(fn (Utente $record): bool => $record->estado == 1),
            Tables\Actions\DeleteAction::make()
                ->visible(fn (Utente $record): bool => $record->estado == 1)
        ];
    }

    public function render(): View
    {
        return view('livewire.utentes.list-utentes');
    }
    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn(Model $record): string => route('utentes.show', ['utente' => $record]);
    }
}
