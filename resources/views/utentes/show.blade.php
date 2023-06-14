@php use App\Models\Utente; @endphp
@php use App\Models\UtenteOutrasInf; @endphp
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a href="{{ route('utentes') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6 text-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M11.25 9l-3 3m0 0l3 3m-3-3h7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </a>
            <div class="flex items-center gap-6">
                <div class="text-right">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $utente->nome }}
                    </h2>
                    <p class="text-sm font-semibold text-blue-600/75 dark:text-blue-500/75">
                        @if($utente->estado == 1)
                            Processo não submetido
                        @else
                            # {{ $utente->nproc }} /
                            Estado: {{ Utente::getEstados()[$utente->estado] }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-6">
            {{-- Informações Gerais --}}
            <div class="bg-white overflow-hidden shadow-xl p-6 rounded-lg mx-3 md:mx-0">
                <h3 class="text-lg font-semibold text-blue-600/75 dark:text-blue-500/75">Informações Gerais</h3>
                <div class="grid md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Nome</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->nome }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Nome Tratamento</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->nome_trata }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Telemóvel</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->tlm }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">E-mail</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->email }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Data de Nascimento</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->dt_nasc }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Estado Civil</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ Utente::getEstadosCivis()[$utente->tipo_estado_civil] }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Cartão de Cidadão</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->cc }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Nº de Identificação Fiscal</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->nif }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Nº de Segurança Social</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->ss }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Data de Nascimento</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->sistSaude->nome }}</p>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-md text-gray-800 leading-tight mt-4">Observações</h4>
                    <p class="font-normal text-sm text-gray-800 leading-tight mt-2">
                        @if($utente->obs == null)
                            Sem observações
                        @else
                            {{ $utente->obs }}
                        @endif
                    </p>
                </div>
            </div>
            {{-- Fim Informações Gerais --}}

            {{-- Outras Informações --}}
            <div class="bg-white overflow-hidden shadow-xl p-6 rounded-lg mx-3 md:mx-0 mt-4">
                <h3 class="text-lg font-semibold text-blue-600/75 dark:text-blue-500/75">Outras Informações</h3>
                <div class="grid md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <h4 class="font-semibold text-md text-gray-800 leading-tight">Morada</h4>
                            <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infOutras->morada }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-md text-gray-800 leading-tight">Código Postal</h4>
                            <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infOutras->cp1 }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-md text-gray-800 leading-tight">Zona Postal</h4>
                            <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infOutras->cp2 }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-md text-gray-800 leading-tight">Localidade</h4>
                            <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infOutras->localidade }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-md text-gray-800 leading-tight">Próximo da Instituição</h4>
                            <p class="font-normal text-sm text-gray-800 leading-tight">
                                @if($utente->infOutras->is_proximo_na_instituicao == 0)
                                    Sim
                                @else
                                    Não
                                @endif
                            </p>
                            <p class="font-normal text-sm text-gray-800 leading-tight">
                                {{ $utente->infOutras->proximo_na_instituicao }}
                            </p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-md text-gray-800 leading-tight">Data da Visita às Instalações
                                da Resposta Social</h4>
                            <p class="font-normal text-sm text-gray-800 leading-tight">
                                @if($utente->infOutras->dt_visita == null)
                                    Sem data de visita
                                @else
                                    {{ $utente->infOutras->dt_visita }}
                                @endif
                            </p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-md text-gray-800 leading-tight">Naturalidade</h4>
                            <p class="font-normal text-sm text-gray-800 leading-tight">
                                {{ $utente->infOutras->naturalidade }}
                            </p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-md text-gray-800 leading-tight">Tipo Habilitações</h4>
                            <p class="font-normal text-sm text-gray-800 leading-tight">
                                @if($utente->infOutras->tipo_habilitacoes == 0)
                                    Não preenchido
                                @else
                                    {{ UtenteOutrasInf::escolaridade()[$utente->infOutras->tipo_habilitacoes] }}
                                @endif
                            </p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Descrição das Habilitações</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">
                            @if($utente->infOutras->habilitacoes_desc == null)
                                Sem observações
                            @else
                                {{ $utente->infOutras->habilitacoes_desc }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            {{-- Fim Outras Informações --}}

            {{-- Informações Económicas --}}
            <div class="bg-white overflow-hidden shadow-xl p-6 rounded-lg mx-3 md:mx-0 mt-4">
                <h3 class="text-lg font-semibold text-blue-600/75 dark:text-blue-500/75">Informações Económicas</h3>
                <div class="gap-4 mt-4 md:grid md:grid-cols-2">
                    <div>
                        <h4 class="text-lg mb-4 font-medium text-blue-600/75 dark:text-blue-500/75">Rendimentos
                            Mensais</h4>
                        <div class="flex flex-col gap-6">
                            <div>
                                <h4 class="font-semibold text-md text-gray-800 leading-tight">Rendimento do
                                    Trabalho</h4>
                                <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infEconomica->rendimento_trabalho }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-md text-gray-800 leading-tight">Reforma</h4>
                                <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infEconomica->reforma }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-md text-gray-800 leading-tight">Pensão</h4>
                                <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infEconomica->pensao }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-md text-gray-800 leading-tight">Complemento por
                                    Dependência</h4>
                                <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infEconomica->complemento_dep }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-md text-gray-800 leading-tight">Outros</h4>
                                <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infEconomica->outro_rendimento }}</p>
                            </div>
                        </div>
                    </div>


                    <div>
                        <h4 class="text-lg my-4 md:mt-0 font-medium text-blue-600/75 dark:text-blue-500/75">
                            Despesas Mensais</h4>
                        <div class="flex flex-col gap-6 md:grid md:grid-cols-2">
                            <div class="grid gap-6">
                                <div>
                                    <h4 class="font-semibold text-md text-gray-800 leading-tight">Medicação</h4>
                                    <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infEconomica->medicacao }}</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-md text-gray-800 leading-tight">Renda da Casa</h4>
                                    <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infEconomica->renda }}</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-md text-gray-800 leading-tight">Custos Água</h4>
                                    <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infEconomica->agua }}</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-md text-gray-800 leading-tight">Custos Gás</h4>
                                    <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infEconomica->gaz }}</p>
                                </div>
                            </div>
                            <div class="grid gap-6">
                                <div>
                                    <h4 class="font-semibold text-md text-gray-800 leading-tight">Custos Energia</h4>
                                    <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infEconomica->energia }}</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-md text-gray-800 leading-tight">Custos Telefone</h4>
                                    <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infEconomica->telefone }}</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-md text-gray-800 leading-tight">Alimentação</h4>
                                    <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infEconomica->alimentacao }}</p>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-md text-gray-800 leading-tight">Outros</h4>
                                    <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->infEconomica->outra_despesa }}</p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            {{-- Fim Informações Económicas --}}

            {{-- Informações Gerais --}}
            <div class="bg-white overflow-hidden shadow-xl p-6 rounded-lg mx-3 md:mx-0 mt-4">
                <h3 class="text-lg font-semibold text-blue-600/75 dark:text-blue-500/75">Informações do Familiar Responsável</h3>
                <div class="grid md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Nome</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->famResponsavel->nome }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Morada</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->famResponsavel->morada }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Código Postal</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->famResponsavel->cp1 }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Zona Postal</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->famResponsavel->cp2 }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Localidade</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->famResponsavel->localidade }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Telemóvel</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->famResponsavel->tlm }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Telefone</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->famResponsavel->tlf }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">E-mail</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->famResponsavel->email }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Data de Nascimento</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->famResponsavel->dt_nasc }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Cartão de Cidadão</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->famResponsavel->cc }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Nº de Identificação Fiscal</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->famResponsavel->nif }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-md text-gray-800 leading-tight">Nº de Segurança Social</h4>
                        <p class="font-normal text-sm text-gray-800 leading-tight">{{ $utente->famResponsavel->ss }}</p>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-md text-gray-800 leading-tight mt-4">Observações</h4>
                    <p class="font-normal text-sm text-gray-800 leading-tight mt-2">
                        @if($utente->obs == null)
                            Sem observações
                        @else
                            {{ $utente->obs }}
                        @endif
                    </p>
                </div>
            </div>
            {{-- Fim Informações Gerais --}}

            <div class="bg-white overflow-hidden shadow-xl p-6 rounded-lg mx-3 md:mx-0 mt-4">
                <h3 class="text-lg font-semibold text-blue-600/75 dark:text-blue-500/75">Suporte</h3>
                <div class="grid md:grid-cols-2 gap-4 mt-4">
                    @if ($utente->suporte->is_necessita_suporte == 0)
                        <div>
                            <h4 class="font-semibold text-md text-gray-800 leading-tight">Necessita de suporte para satisfazer e/ou desenvolver atividades quotidianas</h4>
                            <p class="font-normal text-sm text-gray-800 leading-tight">Não</p>
                        </div>
                    @else
                        <div>
                            <h4 class="font-semibold text-md text-gray-800 leading-tight">Tipo de Suporte</h4>
                            <p class="font-normal text-sm text-gray-800 leading-tight">
                                {{ \App\Models\UtenteSuporte::getTipoSuporte()[$utente->suporte->tipo_suporte_existente] }}
                            </p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-md text-gray-800 leading-tight">Grau de dependência global</h4>
                            <p class="font-normal text-sm text-gray-800 leading-tight">
                                {{ \App\Models\UtenteSuporte::getGrauDependencia()[$utente->suporte->tipo_grau_dependencia] }}
                            </p>
                        </div>
                    @endif
                </div>
                <div class="text-lg my-4 font-medium text-blue-600/75 dark:text-blue-500/75">
                    Deficiência
                    <p class="font-normal text-sm text-gray-800 leading-tight mt-2">Mental:
                        @if($utente->is_deficiencia_mental == 0)
                            Não
                        @else
                            Sim
                        @endif
                    </p>
                    <p class="font-normal text-sm text-gray-800 leading-tight mt-2">Visual:
                        @if($utente->is_deficiencia_visual == 0)
                            Não
                        @else
                            Sim
                        @endif
                    </p>
                    <p class="font-normal text-sm text-gray-800 leading-tight mt-2">Motora:
                        @if($utente->is_deficiencia_motora == 0)
                            Não
                        @else
                            Sim
                        @endif
                    </p>
                    <p class="font-normal text-sm text-gray-800 leading-tight mt-2">Motora:
                        @if($utente->is_deficiencia_auditiva == 0)
                            Não
                        @else
                            Sim
                        @endif
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold text-md text-gray-800 leading-tight">Descrição das Habilitações</h4>
                    <p class="font-normal text-sm text-gray-800 leading-tight">
                        @if($utente->infOutras->habilitacoes_desc == null)
                            Sem observações
                        @else
                            {{ $utente->infOutras->habilitacoes_desc }}
                        @endif
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto shadow-xl m-6 rounded-lg mx-3 md:mx-0 mt-4">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-blue-600">
                            Nome do Familiar
                        </th>
                        <th scope="col" class="px-6 py-3 text-blue-600">
                            Data de Nascimento
                        </th>
                        <th scope="col" class="px-6 py-3 text-blue-600">
                            Parentesco
                        </th>
                        <th scope="col" class="px-6 py-3 text-blue-600">
                            Vive com o Utente
                        </th>
                        <th scope="col" class="px-6 py-3 text-blue-600">
                            Frequenta a Instituição
                        </th>
                        <th scope="col" class="px-6 py-3 text-blue-600">
                            Meio de Vida Principal
                        </th>
                        <th scope="col" class="px-6 py-3 text-blue-600">
                            Rendimento Mensal
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($utente->famUtente as $fam)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $fam->nome }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $fam->dt_nasc }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Utente::getParentescos()[$fam->tipo_parentesco] }}
                        </td>
                        <td class="px-6 py-4">
                            @if($utente->is_vive_com == 0)
                                Não
                            @else
                                Sim
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($utente->is_frequenta == 0)
                                Não
                            @else
                                Sim
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ Utente::getParentescos()[$fam->tipo_meio_vida] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $fam->rendimento_mensal }}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
