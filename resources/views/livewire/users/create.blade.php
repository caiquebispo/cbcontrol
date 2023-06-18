<x-card title="Cadastrar Usuário">
    <x-errors />
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
        
        <x-button type="submit" icon="pencil" primary label="Cadastrar" class="my-2" />
    </form>

</x-card>