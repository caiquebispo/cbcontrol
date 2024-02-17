<x-native-select label="Forma de Pagamento" placeholder="Forma de Pagamento" :options="[
    ['paymentMethod' => 'Cartão de Crédito/Débito', 'value' => 'credit_card'],
    ['paymentMethod' => 'Pix/ Tranferência', 'value' => 'pix_or_transfer_bank'],
    ['paymentMethod' => 'À vista', 'value' => 'cash'],
    ['paymentMethod' => 'Na nota', 'value' => 'in_count'],
]" option-label="paymentMethod"
    option-value="value" wire:model.defer="paymentMethod" />
