<div>
    <form>
        {{ $this->form }}

        <div class="mt-8">
            <x-button wire:click.prevent="save" type="submit"
                                class="w-full justify-center mt-5 py-2">
                Guardar*
            </x-button>
            <p class="text-gray-600 leading-tight text-sm text-right mt-2">
                *Ao guardar o formulário, os dados são guardados e poderá editá-lo novamente se necessário.
            </p>
            <x-button wire:click.prevent="submit" type="submit"
                      class="w-full justify-center mt-3 py-2">
                Submeter*
            </x-button>
            <p class="text-gray-600 leading-tight text-sm text-right mt-2">
                *Ao submeter o formulário os dados são validados e guardados, se estiverem corretos o processo será criado e não poderá editá-lo novamente.
            </p>
        </div>
    </form>
</div>
