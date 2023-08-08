<?php

namespace App\Class\Store\Checkout;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use WireUi\Traits\Actions;

class ProcessingCheckout
{
    use Actions;
    public function __construct(
        protected ?object $company = null,
        protected ?object $user = null,
        protected ?object $address = null,
        protected ?string $paymentMethod = null,
        protected ?string $delivery_method = null,
        protected ?float $amount = null,
        protected ?bool $hasExchange = null,
    ){}
    public  function  processing(): void
    {
        $address_id = ($this->address instanceof Collection)? $this->address->get('id') : $this->address->id;
        $this->storeOrder($this->company->id, $this->user->id,$address_id,$this->paymentMethod, $this->delivery_method,$this->hasExchange, $this->amount);
    }
    private function  storeOrder($company_id,$user_id,$address_id,$paymentMethod, $delivery_method,$hasExchange, $amount): void{

        $order = Order::create([
            'user_id'               => $user_id,
            'company_id'            => $company_id,
            'address_id'            => $address_id,
            'day'                   => (new \DateTime('now'))->format('Y-m-d'),
            'total_amount'          => \Cart::subtotal(),
            'payment_method'        => $paymentMethod,
            'delivery_method'       => $delivery_method,
            'hasExchange'           => $hasExchange ?? 0,
            'amount'                => $amount ?: 0.00,
            'quantityItem'          => sizeof(\Cart::content()),
            'status_order'          => 'new',
        ]);

        $this->mountedStructureOrderProducts($order->id, \Cart::content());

    }
    private  function  mountedStructureOrderProducts($order_id, $orderProducts): void{

        $order_products = [];
        foreach($orderProducts as $key => $item){
            $order_products[] = [
                'order_id' => $order_id,
                'product_id' => $item->id,
                'price' =>  $item->price,
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
        foreach($this->company->users as $user){

            $notification = new \MBarlow\Megaphone\Types\General(
                'Parabéns Você VENDEUUUU!',
                'O usuário(a) '.$this->user->name.' realizou uma compra nova, corre e já corefere.',

            );
            $user->notify($notification);
        }
    }
}
