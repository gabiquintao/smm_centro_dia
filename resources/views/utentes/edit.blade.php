<x-app-layout>
    <x-slot name="header">
    <div class="flex items-center justify-between">
        <a href="{{ route('utentes.show', $utente) }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 9l-3 3m0 0l3 3m-3-3h7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </a>
        <div class="flex items-center gap-6">
            <div class="text-right">
                <p class="text-sm font-semibold text-blue-600/75 dark:text-blue-500/75">
                    #{{ $utente->nproc }}
                </p>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $utente->nome }}
                </h2>
            </div>
        </div>
    </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-3 md:mx-auto sm:px-6 lg:px-8">
            @livewire('utentes.edit-utente', ['utente' => $utente])
        </div>
    </div>
</x-app-layout>
