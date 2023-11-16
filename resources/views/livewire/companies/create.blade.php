<div>
    <x-button label="Cadastrar Empresa" primary md icon="plus-circle" wire:click="$toggle('showModal','true')"/>
    <x-modal.main :title="'Cadastrar Empresa'" :show="$showModal">
        <x-slot:body>
            <form wire:submit.prevent="create" class="my-2">
                @csrf

                <x-button type="submit" primary label="Cadastrar" class="my-2" />
            </form>
        </x-slot:body>
    </x-modal.main>
</div>