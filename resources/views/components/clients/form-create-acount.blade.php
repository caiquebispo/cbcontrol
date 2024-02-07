@props(['groups' => null])
<x-card title="Informações pessoal">
    <x-errors />
    <form wire:submit.prevent="create" class="my-2">
        @csrf
        <x-native-select class="my-2" label="Selecione um grupo para ao cliente" placeholder="Selecionar grupo" :options="$groups" option-label="name" option-value="id" wire:model.defer="client.group_id" />
        <div class="grid md:grid-cols-2 md:gap-6 my-3">
            <div>
                <x-input label="Nome" placeholder="Nome" wire:model.defer="client.full_name" />
            </div>
            <div>
                <x-input label="E-mail" type="email" placeholder="E-mail" wire:model.defer="client.email" />
            </div>
        </div>
        <div class="grid md:grid-cols-1 md:gap-6 my-3">

        </div>
        <div class="grid md:grid-cols-2 md:gap-6 my-2">
            <div>
                <x-input label="WhatsApp" placeholder="WhatsApp" wire:model.defer="client.number_phone" mask="['(##) #####-####', '(##) ####-####']" />
            </div>
            <div>
                <x-input label="Data de Aniversário" type="date" placeholder="Data de Aniversário" wire:model.defer="client.birthday" />
            </div>
        </div>

    </form>

</x-card>