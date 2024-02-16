<?php

namespace App\Class\Store\Checkout;

use App\Models\Order;
use App\Models\OrderProduct;
use DateTime;
use Illuminate\Support\Collection;
use WireUi\Traits\Actions;

class ProcessingCheckout
{
    use Actions;

    public function __construct(
        protected ?object $company = null,
        protected ?object $user = null,
        protected ?object $client = null,
        protected ?object $address = null,
        protected ?string $paymentMethod = null,
        protected ?string $delivery_method = null,
        protected ?bool $hasExchange = null,
        protected ?float $amount = null,
        protected ?string $origin = 'PDV'
    ) {
    }

    public function processing(): void
    {
        $client_id = is_object($this->client) ? $this->client->id : 0;
        $user_id = is_object($this->user) ? $this->user->id : 0;
        $address_id = ($this->address instanceof Collection) ? $this->address->get('id') : $this->address->id;

        $this->storeOrder($this->company->id, $user_id, $client_id, $address_id, $this->paymentMethod, $this->delivery_method, $this->hasExchange, $this->amount, $this->origin);
    }

    private function storeOrder($company_id, $user_id, $client_id, $address_id, $paymentMethod, $delivery_method, $hasExchange, $amount, $origin): void
    {

        $order = Order::create([
            'user_id' => $user_id,
            'client_id' => $client_id,
            'company_id' => $company_id,
            'address_id' => $address_id,
            'day' => (new \DateTime('now'))->format('Y-m-d'),
            'duet_day' => $paymentMethod === 'in_count' ? (new DateTime('now'))->modify('+1 month')->format('Y-m-d') : (new \DateTime('now'))->format('Y-m-d'),
            'total_amount' => $amount,
            'payment_method' => $paymentMethod,
            'payment_status' => $this->setStatusSales($paymentMethod),
            'delivery_method' => $delivery_method,
            'hasExchange' => $hasExchange ?? 0,
            'amount' => $amount ?: 0.00,
            'quantityItem' => count(\Cart::content()),
            'status_order' => $origin == 'PDV' ? 'confirmed' : 'new',
            'origin' => $origin,
            'received_day' => $this->setStatusSales($paymentMethod) != 'pending' ? (new DateTime('now'))->format('Y-m-d') : null,
            'who_received_id' => ($this->setStatusSales($paymentMethod) != 'pending' && $origin == 'PDV') ? $user_id : null,
        ]);

        $this->mountedStructureOrderProducts($order->id, \Cart::content());
    }

    private function setStatusSales($state)
    {
        return match ($state) {
            'in_count' => 'pending',
            'credit_card' => 'confirmed',
            'cash' => 'confirmed',
            'pix_or_transfer_bank' => 'confirmed',
        };
    }

    private function mountedStructureOrderProducts($order_id, $orderProducts): void
    {

        $order_products = [];
        foreach ($orderProducts as $key => $item) {
            $order_products[] = [
                'order_id' => $order_id,
                'product_id' => $item->id,
                'price' => $item->price,
                'quantity' => $item->qty,
                'observation' => $item->options['observation'] ?? 'SEM DESCRIAÇÃO',
                'created_at' => (new \DateTime('now'))->format('Y-m-d H:i:s'),
                'updated_at' => (new \DateTime('now'))->format('Y-m-d H:i:s'),
            ];
        }
        OrderProduct::insert($order_products);
        $this->notifications();
        \Cart::destroy();
    }

    public function notifications(): void
    {
        $message = '';
        if (is_object($this->user)) {
            $message = 'O vendedor(a) ' . $this->user->name . ', realizou uma nova venda para o cliente _client_name_';
        } else {
            $message = 'Parabéns! Você tem uma nova venda do cliente _client_name_';
        }
        foreach ($this->company->users as $user) {

            $notification = new \MBarlow\Megaphone\Types\General(
                $this->origin != 'PDV' ? 'Parabéns Você VENDEUUUU!' : '',
                str_replace('_client_name_', $this->client->full_name, $message)
            );
            $user->notify($notification);
        }
    }
}
