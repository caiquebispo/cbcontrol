<div>
    <x-button-update wire:click="$toggle('showModal', 'true')" />
    <x-modal.main :title="'Editar Rede'" :show="$showModal" size="lg" >
        <x-slot:body>
            <div class="flex justify-center">
                <div class="mx-4">
                <livewire:users.create :network="$network" wire:key="{{ now() }}" />
                </div>
                <livewire:companies.create :network="$network" wire:key="{{ now() }}" />
            </div>
            <!--  Accordion Empresas   -->
            <x-accordion title="Empresas">
                <x-slot:body>
                    <x-table.content-table>
                        <x-table.actions  :showButtonExport="false">
                            <x-slot name="buttonCreate"></x-slot>
                        </x-table.actions>
                        <x-table>
                            <x-table.thead>
                                <x-table.th wire:click.prevent="sortBy('corporate_reason')" :sortable="true" :direction="$sortDirection">NOME</x-table.th>
                                <x-table.th class="text-center">Qt Usuários</x-table.th>
                                <x-table.th class="text-center" wire:click.prevent="sortBy('status')" :sortable="true" :direction="$sortDirection">Status</x-table.th>
                            </x-table.thead>
                            <x-table.tbody>
                                @foreach($companies as $company)
                                    <x-table.tr>
                                        <x-table.th>{{$company->corporate_reason ?? 'NÃO DEFINIDO'}}</x-table.th>
                                        <x-table.th class="text-center">{{count($company->users)}}</x-table.th>
                                        <x-table.th class="text-center">{{$company->status ? 'Ativa' : 'Desativada'}}</x-table.th>
                                        <x-table.th class="text-center">ACTIONS</x-table.th>
                                        <x-table.th class="flex  justify-evenly">
                                            <livewire:companies.modal-update :company="$company" wire:key="{{now()}}"/>
                                            <livewire:companies.delete :company="$company" wire:key="{{now()}}"/>
                                        </x-table.th>

                                    </x-table.tr>
                                @endforeach
                            </x-table.tbody>
                        </x-table>
                        <div class="p-4">
                            {{ $companies->links() }}
                        </div>
                    </x-table.content-table>
                </x-slot:body>
            </x-accordion>
            <!--  Accordion Usuários   -->
            <x-accordion title="Usuários">
                <x-slot:body>
                    <x-table.content-table>
                        <x-table.actions  :showButtonExport="false">
                            <x-slot name="buttonCreate">
                            </x-slot>
                        </x-table.actions>
                        <x-table>
                            <x-table.thead>
                                <x-table.th wire:click.prevent="sortBy('name')" :sortable="true" :direction="$sortDirection">NOME</x-table.th>
                                <x-table.th wire:click.prevent="sortBy('email')" :sortable="true" :direction="$sortDirection">E-MAIL</x-table.th>
                                <x-table.th wire:click.prevent="sortBy('company_id')" :sortable="true" :direction="$sortDirection">EMPRESA</x-table.th>
                                <x-table.th wire:click.prevent="sortBy('status')" :sortable="true" :direction="$sortDirection">STATUS</x-table.th>
                                <x-table.th class="text-center">ACTIONS</x-table.th>
                            </x-table.thead>
                            <x-table.tbody>
                                @foreach($users as $user)
                                    <x-table.tr>
                                        <x-table.th>{{$user->name ?? 'NÃO DEFINIDO'}}</x-table.th>
                                        <x-table.th>{{$user->email ?? 'NÃO DEFINIDO'}}</x-table.th>
                                        <x-table.th>{{$user->company->corporate_reason ?? 'NÃO DEFINIDO'}}</x-table.th>
                                        <x-table.th>{{$user->status }}</x-table.th>
                                        <x-table.th class="flex  justify-evenly">
                                            <livewire:users.update :user="$user" wire:key="{{now()}}" />
                                            <livewire:users.update-password :user="$user" wire:key="{{now()}}" />
                                            <livewire:users.delete :user="$user" wire:key="{{now()}}" />
                                        </x-table.th>
                                    </x-table.tr>
                                @endforeach
                            </x-table.tbody>
                        </x-table>
                        <div class="p-4">
                            {{ $users->links() }}
                        </div>
                    </x-table.content-table>
                </x-slot:body>
            </x-accordion>
        </x-slot:body>
    </x-modal.main>
</div>
