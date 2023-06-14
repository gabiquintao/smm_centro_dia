<div>
    <form wire:submit.prevent="submit">
        <div class="md:mb-8">
            {{ $this->form }}
        </div>

        <div class="flex flex-col md:flex-row justify-between gap-4">
            <p class="mt-6 text-gray-600 leading-tight text-sm">
                Este formulário pode ser posteriormente editado a qualquer momento. Não é permanente.
            </p>
            <x-button wire:click.prevent="create" class="justify-center" type="button">Criar</x-button>
        </div>
    </form>
</div>
