<?php

namespace App\Http\Livewire\Utentes;

use App\Models\FamResponsavel;
use App\Models\Utente;
use App\Models\UtenteAdmissibilidade;
use App\Models\UtenteOutrasInf;
use App\Models\UtenteSuporte;
use App\Validations\UtenteValidation;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditUtente extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Utente $utente;

    public function mount(): void
    {
        $this->form->fill(
            array_merge($this->utente->toArray())
        );
    }

    protected function getFormModel(): Utente
    {
        return $this->utente;
    }

    public function save(): void
    {
        $formData = $this->form->getState();
        $this->utente->update($formData);
        $this->redirect(route('utentes.show', $this->utente));
        Notification::make()
            ->title('Alterações guardadas com sucesso!')
            ->success()
            ->send();
    }

    public function submit(): void
    {
        $formData = $this->form->getState();
        $this->utente->update($formData);
        $this->utente->fill(array_merge($formData, ['estado' => 2]));
        $this->form->model($this->utente)->saveRelationships();

        UtenteAdmissibilidade::create(['utente_id' => $this->utente->id]);

        $this->redirect(route('utentes.show', $this->utente));
        Notification::make()
            ->title('Formulário submetido com sucesso!')
            ->body('Aguarde pela resposta do responsável')
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.utentes.edit-utente');
    }

    protected function getFormSchema(): array
    {
        return [
            // region Informações Gerais
            Section::make('Informações Gerais')
                ->schema([
                    Grid::make(3)
                        ->schema([
                            TextInput::make('nome')
                                ->rules(['max:100', 'min:100'], fn(callable $get) => $get('nome') == 1)
                                ->rules(['max:100', 'min:100'], fn(callable $get) => $get('nome') == 2),
                            TextInput::make('nome_trata')->label('Nome pelo qual gosta de ser tratado')                         ,
                            TextInput::make('tlm')->label('Telemóvel'),
                            TextInput::make('tlf')->label('Telefone'),
                            TextInput::make('email')->label('E-mail'),
                            DatePicker::make('dt_nasc')->label('Data de Nascimento')
                                ->displayFormat('d/m/Y'),
                            Select::make('tipo_estado_civil')->label('Estado Civil')
                                ->options(Utente::getEstadosCivis()),
                            TextInput::make('cc')->label('Cartão de Cidadão')
                                ->hint('8 dígitos e código de 3 caractéres')
                                ->placeholder('01234567ZA3'),
                            TextInput::make('nif')->label('Nº Identificação Fiscal')
                                ->hint('9 dígitos')
                                ->placeholder('012345678'),
                            TextInput::make('ss')->label('Nº Beneficiário da Segurança Social')
                                ->hint('11 dígitos')
                                ->placeholder('01234567891'),
                            TextInput::make('num_utente')->label('Nº Cartão Utente'),
                            Select::make('sist_saude_id')->label('Subsistema de Saúde')
                                ->relationship('sistSaude', 'nome')
                                ->preload(),
                        ]),
                    MarkdownEditor::make('obs')->label('Observações')
                ])
                ->collapsible()
                ->collapsed(),
            // endregion

            // region Outras Informações
            Section::make('Outras Informações')
                ->relationship('infOutras')
                ->schema([
                    Grid::make(3)
                        ->schema([
                            TextInput::make('morada'),
                            TextInput::make('cp1')->label('Código Postal'),
                            TextInput::make('cp2')->label('Zona Postal'),
                            TextInput::make('localidade'),
                            Select::make('tipo_habilitacoes')->label('Habilitações')
                                ->required()
                                ->options(Utente::getHabilitacoes()),
                            Toggle::make('is_proximo_na_instituicao')->label('Localiza-se próximo da instituição?')->inline(false)->required()
                        ]),
                    MarkdownEditor::make('habilitacoes_desc')->label('Descrição das Habilitações')
                ])
                ->collapsible()
                ->collapsed(),
            // endregion

            // region Informações Económicas
            Section::make('Informações Económicas')
                ->relationship('infEconomica')
                ->schema([
                    Fieldset::make('Rendimentos Mensais')
                        ->schema([
                            TextInput::make('rendimento_trabalho')->label('Rendimento do Trabalho')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: '')),
                            TextInput::make('reforma')->label('Reforma')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: '')),
                            TextInput::make('pensao')->label('Pensão')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: '')),
                            TextInput::make('complemento_dep')->label('Complemento por Dependência')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: '')),
                            TextInput::make('outro_rendimento')->label('Outros')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: '')),
                        ])->columns(3),

                    Fieldset::make('Despesas Mensais')
                        ->schema([
                            TextInput::make('medicacao')->label('Medicação')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: '')),
                            TextInput::make('renda')->label('Renda da Csas')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: '')),
                            TextInput::make('agua')->label('Água')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: '')),
                            TextInput::make('gaz')->label('Gás')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: '')),
                            TextInput::make('energia')->label('Luz/Energia')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: '')),
                            TextInput::make('telefone')->label('Telefone')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: '')),
                            TextInput::make('alimentacao')->label('Alimentação')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: '')),
                            TextInput::make('outra_despesa')->label('Outros')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: '')),
                        ])->columns(3)
                ])
                ->collapsible()
                ->collapsed(),
            // endregion

            // region Familiar Responsável
            Section::make('Familiar Responsável')
                ->relationship('famResponsavel')
                ->schema([
                    Grid::make(3)
                        ->schema([
                            TextInput::make('nome'),
                            TextInput::make('morada'),
                            TextInput::make('cp1')->label('Código Postal'),
                            TextInput::make('cp2')->label('Zona Postal'),
                            TextInput::make('localidade'),
                            TextInput::make('tlm')->label('Telemóvel'),
                            TextInput::make('tlf')->label('Telefone'),
                            TextInput::make('email')->label('E-mail'),
                            DatePicker::make('dt_nasc')->label('Data de Nascimento'),
                            TextInput::make('cc')->label('Cartão de Cidadão')
                                ->hint('8 dígitos e código de 3 caractéres')
                                ->placeholder('01234567ZA3'),
                            TextInput::make('nif')->label('Nº Identificação Fiscal')
                                ->hint('9 dígitos')
                                ->placeholder('012345678'),
                            TextInput::make('ss')->label('Nº Beneficiário da Segurança Social')
                                ->hint('11 dígitos')
                                ->placeholder('01234567891'),
                        ]),
                    MarkdownEditor::make('obs')->label('Observações')
                ])
                ->collapsible()
                ->collapsed(),
            // endregion

            // region Rede Social de Suporte
            Section::make('Rede Social de Suporte')
                ->relationship('suporte')
                ->schema([
                    Toggle::make('is_necessita_suporte')->label('O candidato necessita de suporte para satisfazer e/ou desenvolver atividades quotidianas?'),
                    Tabs::make('Rede social de suporte')
                        ->tabs([
                            Tab::make('Rede social de suporte')
                                ->schema([
                                    Radio::make('tipo_suporte_existente')
                                        ->label('Identifique o suporte existente do candidato')
                                        ->options(UtenteSuporte::getTipoSuporte()),
                                ]),
                            Tab::make('Dependência do utente')
                                ->schema([
                                    Radio::make('tipo_grau_dependencia')
                                        ->label('Grau de dependência global do utente')
                                        ->options(UtenteSuporte::getGrauDependencia()),
                                ]),
                            Tab::make('Deficiências')
                                ->schema([
                                    Checkbox::make('is_deficiencia_mental')->label('Mental'),
                                    Checkbox::make('is_deficiencia_visual')->label('Visual'),
                                    Checkbox::make('is_deficiencia_motora')->label('Motora'),
                                    Checkbox::make('is_deficiencia_auditiva')->label('Auditiva'),
                                ]),
                        ]),
                    MarkdownEditor::make('motivo_pedido')->label('Motivo do pedido')
                ])
                ->collapsible()
                ->collapsed(),
            // endregion

            // region Familiares
            Section::make('Familiares')
                ->schema([
                    Repeater::make('famUtente')->label('Familiares')
                        ->relationship()
                        ->schema([
                            TextInput::make('nome'),
                            DatePicker::make('dt_nasc')->label('Data de Nascimento'),
                            Select::make('tipo_parentesco')->label('Parentesco')
                                ->options(Utente::getParentescos()),
                            Select::make('tipo_meio_vida')->label('Meio de Vida Principal')
                                ->options(Utente::getMeioVida()),
                            TextInput::make('rendimento_mensal')->label('Rendimento Mensal')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: '')),
                            Toggle::make('is_vive_com')->label('Vive com o utente?')->inline(false),
                            Toggle::make('is_frequenta')->label('Frequenta a instituição?')->inline(false)
                        ])->columns(2)
                ])
                ->collapsible()
                ->collapsed(),

            Checkbox::make('consentimento')->label('Verifiquei as informações e pretendo proceder a confirmação do processo (apenas necessário se quiser submeter o processo).')
            // endregion
        ];
    }
}
