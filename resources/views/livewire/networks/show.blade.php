<div class="mr-4">
    <x-button-show wire:click="$toggle('showModal', 'true')" />
    <x-modal.main :title="'Visualizar Rede'" :show="$showModal" size="lg">
        <x-slot:body>

            <x-accordion title="Empresas">
                <x-slot:body>
                    Empresas
                </x-slot:body>
            </x-accordion>
            <x-accordion title="Usuários">
                <x-slot:body>
                    Usuários
                </x-slot:body>
            </x-accordion>


        </x-slot:body>
    </x-modal.main>
</div>
<script>
    function sayHello( name ) {
        alert( name + '!')
    }
</script>
