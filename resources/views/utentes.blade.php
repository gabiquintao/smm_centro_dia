<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Os meus utentes') }}
            </h2>
            <a href="{{ route('utentes.create') }}">
                <x-secondary-button>Criar</x-secondary-button>
            </a>

        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-3 md:mx-auto sm:px-6 lg:px-8">
            @livewire('utentes.list-utentes')
        </div>
    </div>
</x-app-layout>
