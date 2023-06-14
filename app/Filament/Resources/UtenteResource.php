<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UtenteResource\Pages;
use App\Filament\Resources\UtenteResource\RelationManagers\FamiliaresRelationManager;
use App\Filament\Resources\UtenteResource\RelationManagers\FamUtenteRelationManager;
use App\Filament\Resources\UtenteResource\Widgets\StatsOverview;
use App\Models\FamUtente;
use App\Models\User;
use App\Models\Utente;
use App\Models\UtenteOutrasInf;
use App\Models\UtenteSuporte;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
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
use Filament\Pages\Actions\Action;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UtenteResource extends Resource implements HasShieldPermissions
{

    protected static function getNavigationGroup(): ?string
    {
        return "Centro de Dia";
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'restore',
            'restore_any',
            'replicate',
            'reorder',
            'delete',
            'delete_any',
            'force_delete',
            'force_delete_any',
            'gerir',
            'edit'
        ];
    }

    protected static ?string $model = Utente::class;

    protected static ?string $modelLabel = "Utente";

    protected static ?string $pluralModelLabel = "Utentes";

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole(['super_admin', 'coordenador'])) {
            return parent::getEloquentQuery();
        }
        return parent::getEloquentQuery()->where('colaborador_id', Auth::id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // region Informações Gerais
                Section::make('Informações Gerais')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('nome'),
                                TextInput::make('nome_trata')->label('Nome pelo qual gosta de ser tratado')                         ,
                                TextInput::make('tlm')->label('Telemóvel'),
                                TextInput::make('tlf')->label('Telefone'),
                                TextInput::make('email')->label('E-mail'),
                                DatePicker::make('dt_nasc')->label('Data de Nascimento')
                                    ->required()
                                    ->displayFormat('d/m/Y'),
                                Select::make('tipo_estado_civil')->label('Estado Civil')
                                    ->required()
                                    ->options(Utente::getEstadosCivis()),
                                TextInput::make('cc')->label('Cartão de Cidadão'),
                                TextInput::make('nif')->label('Nº Identificação Fiscal'),
                                TextInput::make('ss')->label('Nº Beneficiário da Segurança Social'),
                                TextInput::make('num_utente')->label('Nº Cartão Utente'),
                                Select::make('sist_saude_id')->label('Subsistema de Saúde')
                                    ->required()
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
                                Toggle::make('is_proximo_na_instituicao')->label('Localiza-se próximo da instituição?')->inline(false)
                            ]),
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
                                TextInput::make('rendimento_trabalho')->label('Rendimento do Trabalho')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ''))->default(0),
                                TextInput::make('reforma')->label('Reforma')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ''))->default(0),
                                TextInput::make('pensao')->label('Pensão')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ''))->default(0),
                                TextInput::make('complemento_dep')->label('Complemento por Dependência')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ''))->default(0),
                                TextInput::make('outro_rendimento')->label('Outros')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ''))->default(0),
                            ])->columns(3),

                        Fieldset::make('Despesas Mensais')
                            ->schema([
                                TextInput::make('medicacao')->label('Medicação')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ''))->default(0),
                                TextInput::make('renda')->label('Renda da Csas')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ''))->default(0),
                                TextInput::make('agua')->label('Água')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ''))->default(0),
                                TextInput::make('gaz')->label('Gás')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ''))->default(0),
                                TextInput::make('energia')->label('Luz/Energia')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ''))->default(0),
                                TextInput::make('telefone')->label('Telefone')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ''))->default(0),
                                TextInput::make('alimentacao')->label('Alimentação')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ''))->default(0),
                                TextInput::make('outra_despesa')->label('Outros')->mask(fn(TextInput\Mask $mask) => $mask->money(prefix: '€', thousandsSeparator: ''))->default(0),
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
                                DatePicker::make('dt_nasc')->label('Data de Nascimento')->required(),
                                TextInput::make('cc')->label('Cartão de Cidadão'),
                                TextInput::make('nif')->label('Nº Identificação Fiscal'),
                                TextInput::make('ss')->label('Nº Beneficiário da Segurança Social'),
                            ]),
                        MarkdownEditor::make('obs')->label('Observações')
                    ])
                    ->collapsible()
                    ->collapsed(),
                // endregion

                // region Redes Social de Suporte
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
                                        CheckboxList::make('tipo_grau_dependencia')
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nproc')->label('#')->searchable()->sortable(),
                TextColumn::make('nome')->searchable()->sortable(),
                BadgeColumn::make('estado')
                    ->enum(Utente::getEstados()),
                TextColumn::make('created_at')->label('Criado a')->sortable(),
                TextColumn::make('updated_at')->label('Alterado a')->sortable(),
            ])
            ->filters([
                SelectFilter::make('estado')
                    ->options(Utente::getEstados())
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->visible(auth()->user()->hasRole(['super_admin'])),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            FamUtenteRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        $pages = [
            'index' => Pages\ListUtentes::route('/'),
            'view' => Pages\ViewUtente::route('/{record}'),
        ];

        $utente = Utente::class;
        $editPage = Pages\EditUtente::route('/{record}/edit');
        if ($utente::where('estado', 2 && 3)) {
            $pages['edit'] = $editPage;
        }

        return $pages;
    }

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class
        ];
    }
}
