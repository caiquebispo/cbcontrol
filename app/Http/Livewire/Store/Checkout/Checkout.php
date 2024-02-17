<?php

namespace App\Http\Livewire\Store\Checkout;

use App\Class\Store\Checkout\ProcessingCheckout;
use App\Http\Livewire\Store\Cart\TotalItensCart;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class Checkout extends ModalComponent
{
    public Product $product;

    public Company $company;

    public ?int $step = 1;

    public ?string $paymentMethod = '';

    public ?string $delivery_method = '';

    public ?float $amount = null;

    public ?bool $hasExchange = false;

    public ?string $successMessage = '';

    public ?array $user = [];

    public $address = [];

    public function mount(Product $product): void
    {
        $this->product = $product;
        $this->company = $this->product->company;
    }

    public function render(): View
    {
        return view('livewire.store.checkout.checkout');
    }

    public function nextStep(): void
    {
        match ($this->step) {
            1 => $this->step,
            2 => $this->validateDataUser(),
            3 => $this->validatePaymentMethod(),
            4 => $this->validateAddressUser(),
            default => $this->step++,
        };

        if ($this->step < 5) {
            $this->step++;
        } else {

            $full_name = ['full_name' => Arr::only($this->user['user'], ['name'])['name']];
            $data = array_merge($full_name, Arr::except($this->user['user'], ['password_confirm', 'name']));
            $user = $this->product->company->clients()->create($data);
            $address = is_string($this->address) ? collect(json_decode($this->address, true)) : $user->address()->create($this->address['address']);

            (new ProcessingCheckout(
                $this->product->company,
                null,
                $user,
                $address,
                $this->paymentMethod,
                $this->delivery_method,
                $this->hasExchange,
                \Cart::subtotal(),
                \Cart::subtotal(),
                null,
                null,
                null,
                'SITE'
            ))->processing();
            $this->forceClose()->closeModal();
            $this->emit('cartItem::index::cleanCart');
            $this->emitTo(TotalItensCart::class, 'cartItem::index::addToCart');
        }
    }

    public function previousStep(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function resetCheckoutField(): void
    {
        $this->reset();
    }

    public function validateDataUser(): void
    {
        if (!Auth::check()) {
            $this->user = $this->validate([
                'user.name' => 'required|min:3',
                'user.email' => 'required|email',
                'user.number_phone' => 'required',
                'user.password' => 'required|min:8|max:16',
                'user.password_confirm' => 'required|min:8|max:16|same:user.password',
            ]);
        }
    }

    public function validatePaymentMethod(): void
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

    public function validateAddressUser(): void
    {
        if (!Auth::check()) {
            $this->address = $this->validate([
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
}
