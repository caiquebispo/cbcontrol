<?php

namespace App\Http\Livewire\Store\Checkout;


use App\Models\Company;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;
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
        'city' => '',
        'cep' => '',
        'neighborhood' => '',
        'street' => '',
        'number' => '',
        'proximity' => '',
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
//            $this->user = array_pop($this->user['user']);
//            dd($this->user);
//           User::create();
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
