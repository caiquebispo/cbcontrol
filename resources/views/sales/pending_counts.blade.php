
<x-table.content-table>
    <x-table>
        <x-table.thead>
            <x-table.th class="text-center">CLIENTE</x-table.th>
            <x-table.th class="text-center">VENDEDOR</x-table.th>
            <x-table.th class="text-center">ENTREGADOR</x-table.th>
            <x-table.th class="text-center">TIPO/PG</x-table.th>
            <x-table.th class="text-center">VALOR</x-table.th>
            <x-table.th class="text-center">HAV</x-table.th>
            <x-table.th class="text-center">RESTA</x-table.th>
            <x-table.th class="text-center">STATUS/PG</x-table.th>
            <x-table.th class="text-center">DT/COMPRA</x-table.th>
            <x-table.th class="text-center">DT/VENCIMENTO</x-table.th>
        </x-table.thead>
        <x-table.tbody>
            @foreach ($orders as $order)
                <x-table.tr>
                    <x-table.th class="text-center">{{ $order['client_name'] }}</x-table.th>
                    <x-table.th class="text-center">{{ $order['seller_name'] }}</x-table.th>
                    <x-table.th class="text-center">{{ $order['delivery_man'] }}</x-table.th>
                    <x-table.th class="text-center">{{ $order['type_payment_sale'] }}</x-table.th>
                    <x-table.th class="text-center">{{ $order['value'] }}</x-table.th>
                    <x-table.th class="text-center">{{ $order['hav'] }}</x-table.th>
                    <x-table.th class="text-center">{{ $order['remain'] }}</x-table.th>
                    <x-table.th class=text-center>
                        <div
                            class=" text-white p-1 rounded-md @if ($order['payment_status'] == 'PENDENTE') bg-red-300 @else bg-green-300 @endif">
                            {{ $order['payment_status'] }}
                        </div>
                    </x-table.th>
                    <x-table.th class="text-center">{{ $order['date'] }}</x-table.th>
                    <x-table.th class="text-center">{{ $order['duet_day'] }}</x-table.th>
                </x-table.tr>
            @endforeach
        </x-table.tbody>
    </x-table>
</x-table.content-table>
