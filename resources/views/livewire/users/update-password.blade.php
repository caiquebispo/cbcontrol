<div>
    <x-button-change-password wire:click="$toggle('showModal', 'true')" />
    <x-modal.main :title="'Rsetar Senha'" :show="$showModal">
        <x-slot:body>
            <form wire:submit.prevent="update" class="my-2">
            @csrf

            <div class="grid md:grid-cols-2 md:gap-6 my-3">
                <div>
                    <x-input label="Senha" placeholder="Senha" type="password" wire:model.defer="password" />
                </div>
                <div>
                    <x-input label="Confirmação da Senha" type="date" placeholder="Confirmação da Senha" type="password" wire:model.defer="password_confirm" />
                </div>
            </div>
            <x-button type="submit" primary label="Atualizar Senha" class="my-2" />
            </form>
        </x-slot:body>
    </x-modal.main>
</div>
