<?php

namespace App\Http\Livewire\Store\Checkout;


use App\Models\Company;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use LivewireUI\Modal\ModalComponent;

class Checkout extends ModalComponent
{
    public  Product $product;
    public  Company $company;
    public int $step = 1;
    public array $user = [
        'name' => '',
        'email' => '',
        'number_phone' => '',
        'password' => '',
    ];
    public array $address = [
        'states' => '',
        'zipe_code' => '',
        'city' => '',
        'neighborhood' => '',
        'road' => '',
        'number' => '',
        'complement' => '',
    ];
    public $paymentMethod = '';
    public $delivery_method = 'delivery';
    public $amount;
    public $hasExchange = false;

    public $successMessage = '';

    public  function  mount(Product $product): void
    {
        $this->product = $product;
        $this->company = $this->product->company;
    }
    public function render(): View
    {
        return view('livewire.store.checkout.checkout');
    }
    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validateStep1();
        } elseif ($this->step === 2) {
            $this->validateStep2();
        } elseif ($this->step === 3) {
            $this->validateStep3();
        } elseif ($this->step === 4) {
            $this->validateStep4();
        }

        if ($this->step < 5) {
            $this->step++;
        } else {

           $user = User::create(Arr::except($this->user, ['password_confirm']));
           $user->address()->create(Arr::except($this->address,['cep']));

          $order = Order::create([
                'user_id'               => $user->id,
                'company_id'            => $this->product->company->id,
                'day'                   => (new \DateTime('now'))->format('Y-m-d'),
                'total_amount'          => \Cart::subtotal(),
                'payment_method'        => $this->paymentMethod,
                'delivery_method'       => $this->delivery_method,
                'hasExchange'           => $this->hasExchange,
                'quantityItem'          => sizeof(\Cart::content()),
                'status_order'          => 'received',
            ]);
            foreach(\Cart::content() as $key => $item){
                OrderProduct::create([
                  'order_id' => $order->id,
                  'product_id' => $item->id,
                  'price' =>  $item->price,
                  'quantity' => $item->qty,
                  'observation' => $item->options['observation'] ?? 'SEM DESCRIAÇÃO'
                ]);
            }
            $this->successMessage = 'Pedido concluído com sucesso!';
        }
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function resetCheckout()
    {
        $this->reset([
            'step',
            'user',
            'address',
            'paymentMethod',
            'amount',
            'hasExchange',
            'successMessage',
        ]);
    }

    public function validateStep1()
    {
        // Validações para a etapa 1 (resumo do carrinho), se necessário
    }

    public function validateStep2()
    {
         $this->validate([
            'user.name' => 'required|min:3',
            'user.email' => 'nullable|email',
            'user.number_phone' => 'required',
            'user.password' => 'required|min:8|max:16',
            'user.password_confirm' => 'required|min:8|max:16|same:user.password'
        ]);


    }

    public function validateStep3()
    {
        $this->validate([
            'paymentMethod' => 'required',
        ]);

        if ($this->paymentMethod === 'cash') {
            $this->validate([
                'amount' => 'required|numeric|min:0',
            ]);
        }
    }

    public function validateStep4()
    {
        $this->validate([
            'address.states' => 'required|max:150',
            'address.zipe_code' => 'required',
            'address.city' => 'required',
            'address.neighborhood' => 'required',
            'address.road' => 'required',
            'address.number' => 'nullable',
            'address.complement' => 'nullable',
        ]);
    }
}
