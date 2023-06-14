<?php

namespace App\Http\Livewire\Utentes;

use App\Models\DocUtente;
use App\Models\FamResponsavel;
use App\Models\Utente;
use App\Models\UtenteInfEconomica;
use App\Models\UtenteOutrasInf;
use App\Models\UtenteSuporte;
use App\Validations\UtenteValidation;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateUtente extends Component implements HasForms
{
    use InteractsWithForms;

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormModel(): string
    {
        return Utente::class;
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    public function create()
    {
        $utente = Utente::create($this->form->getState());
        $utente['user_id'] = auth()->user()->id;
        $utente['estado'] = 1;
        $this->form->model($utente)->saveRelationships();

        UtenteInfEconomica::create(['utente_id' => $utente->id]);
        UtenteOutrasInf::create(['utente_id' => $utente->id]);
        UtenteSuporte::create(['utente_id' => $utente->id]);
        FamResponsavel::create(['utente_id' => $utente->id]);

        Notification::make()
            ->title('Utente criado com sucesso.')
            ->success()
            ->send();

        return redirect()->route('utentes');
    }

    public function render(): View
    {
        return view('livewire.utentes.create-utente');
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(3)
                ->schema([
                    TextInput::make('nome')
                        ->required(),
                    TextInput::make('nome_trata')->label('Nome pelo qual gosta de ser tratado'),
                    TextInput::make('tlm')->label('Telemóvel')
                        ->required(),
                    TextInput::make('tlf')->label('Telefone'),
                    TextInput::make('email')->label('E-mail')
                        ->required(),
                    DatePicker::make('dt_nasc')->label('Data de Nascimento')
                        ->required()
                        ->displayFormat('d/m/Y'),
                    Select::make('tipo_estado_civil')->label('Estado Civil')
                        ->required()
                        ->options(Utente::getEstadosCivis()),
                    TextInput::make('cc')->label('Cartão de Cidadão')
                        ->hint('8 dígitos e código de 3 caractéres')
                        ->placeholder('01234567ZA3')
                        ->required(),
                    TextInput::make('nif')->label('Nº Identificação Fiscal')
                        ->hint('9 dígitos')
                        ->placeholder('012345678')
                        ->required(),
                    TextInput::make('ss')->label('Nº Beneficiário da Segurança Social')
                        ->hint('11 dígitos')
                        ->placeholder('01234567891')
                        ->required(),
                    TextInput::make('num_utente')->label('Nº Cartão Utente')
                        ->hint('9 dígitos')
                        ->placeholder('012345678')
                        ->required(),
                    Select::make('sist_saude_id')->label('Subsistema de Saúde')
                        ->required()
                        ->relationship('sistSaude', 'nome')
                        ->preload(),
                ])
        ];
    }
}
