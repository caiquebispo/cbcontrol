<div>
    <x-button label="Cadastrar Cliente" primary md icon="plus-circle" wire:click="$toggle('showModal', 'true')" />
    <x-modal.main :title="'Cadastrar Cliente'" :show="$showModal" size="lg">
        <x-slot:body>
            <div>
                @if ($step === 1)
                <x-store.checkout.form-create-acount />
                @elseif ($step === 2)
                <x-store.checkout.register-address />
                @endif
                @if ($step === 5)
                <x-store.checkout.thaks-for-buy-with-we />
                @endif
            </div>
            <x-store.checkout.next-steps-buttons :step="$step" />

        </x-slot:body>
    </x-modal.main>

</div>