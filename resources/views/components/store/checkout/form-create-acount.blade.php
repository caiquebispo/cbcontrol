@props(['groups' => null]);
<x-card title="Informações pessoal">
    <x-errors />
    <form wire:submit.prevent="create" class="my-2">
        @csrf
        <x-native-select class="my-2" label="Selecione um grupo para ao cliente" placeholder="Selecionar grupo" :options="$groups" option-label="name" option-value="id" wire:model.defer="user.group_id" />
        <div class="grid md:grid-cols-2 md:gap-6 my-3">
            <div>
                <x-input label="Nome" placeholder="Nome" wire:model.defer="user.name" />
            </div>
            <div>
                <x-input label="E-mail" type="email" placeholder="E-mail" wire:model.defer="user.email" />
            </div>
        </div>
        <div class="grid md:grid-cols-1 md:gap-6 my-3">
            <div>
                <x-input label="WhatsApp" placeholder="WhatsApp" wire:model.defer="user.number_phone" mask="['(##) #####-####', '(##) ####-####']" />
            </div>
        </div>
        <div class="grid md:grid-cols-2 md:gap-6 my-3">
            <div>
                <x-input label="Senha" placeholder="Senha" type="password" wire:model.defer="user.password" />
            </div>
            <div>
                <x-input label="Confirmação da Senha" type="date" placeholder="Confirmação da Senha" type="password" wire:model.defer="user.password_confirm" />
            </div>
        </div>

    </form>

</x-card>