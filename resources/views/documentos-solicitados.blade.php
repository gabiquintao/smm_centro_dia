<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mx-3 md:mx-auto rounded-lg mt-6">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                <x-authentication-card-logo class="block h-16 w-auto"/>

                <h1 class="mt-8 text-2xl font-medium text-gray-900">
                    Documentos solicitados
                </h1>

                <p class="mt-6 text-gray-500 leading-relaxed">
                    Para o processo de admissão ao Centro Social Paroquial de Nª Sª de Fátima, são necessários os seguintes documentos:
                </p>
            </div>

            <div class="bg-gray-200 bg-opacity-25 p-6">
                <li>Cópia do Bilhete de Identidade/Cartão de Cidadão do utente e representante legal;</li>
                <li>Cópia do Cartão de Contribuinte do utente e do representante legal;</li>
                <li>Número de Identificação da Segurança Social do utente e do representante legal;</li>
                <li>Cópia do Cartão de Beneficiário do Serviço Nacional de Saúde ou outro subsistema;</li>
                <li>Boletim de Vacinas e Relatório Médico, comprovativo da situação clínica do utente, posologia dos medicamentos a tomar, dieta alimentar;</li>
                <li>Recibo atualizado da reforma (subsídio ou pensão);</li>
                <li>Modelo 3 de I.R.S. e respetivos anexos;</li>
                <li>Documento(s) comprovativo(s) da média mensal de gastos em medicamentos;</li>
                <li>Documento(s) comprovativo(s) de encargos com a habitação (recibo da renda e respetivo contrato da Instituição Bancária, em caso de empréstimo para a habitação);</li>
                <li>Os encargos médios mensais com transportes públicos.</li>
            </div>
        </div>
    </div>
</x-app-layout>
