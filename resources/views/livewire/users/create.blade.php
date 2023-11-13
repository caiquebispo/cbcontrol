<div>
    <x-button label="Cadastrar" primary md icon="plus-circle" wire:click="$toggle('showModal','true')"/>
    <x-modal.main :title="'Cadastrar Usuário'" :show="$showModal">
        <x-slot:body>
            <form wire:submit.prevent="create" class="my-2">
                @csrf
                <div class="grid md:grid-cols-2 md:gap-6 my-3">
                    <div>
                        <x-input label="Nome" placeholder="Nome" wire:model.defer="name" />
                    </div>
                    <div>
                        <x-input label="E-mail" type="email" placeholder="E-mail" wire:model.defer="email" />
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6 my-3">
                    <div>
                        <x-input label="Telefone" placeholder="Telefone" wire:model.defer="number_phone" />
                    </div>
                    <div>
                        <x-input label="Data de Aniversário" type="date" placeholder="Data de Aniversário" wire:model.defer="birthday" />
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6 my-3">
                    <div>
                        <x-input label="Senha" placeholder="Senha" type="password" wire:model.defer="password" />
                    </div>
                    <div>
                        <x-input label="Confirmação da Senha" type="date" placeholder="Confirmação da Senha" type="password" wire:model.defer="password_confirm" />
                    </div>
                </div>

                <x-button type="submit" primary label="Cadastrar" class="my-2" />
            </form>
        </x-slot:body>
    </x-modal.main>
</div>
