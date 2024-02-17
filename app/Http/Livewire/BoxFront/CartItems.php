<?php

namespace App\Http\Livewire\BoxFront;

use App\Class\App\BoxFront\ProcessingCartItemsCheckout;
use App\Class\Store\Checkout\ProcessingCheckout;
use App\Http\Controllers\SalesController;
use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Whoops\Run;
use WireUi\Traits\Actions;

class CartItems extends Component
{
    use Actions;

    public ?int $client_id = null;
    public ?int $delivery_man_id = null;

    public ?string $paymentMethod = 'in_count';
    public ?string $delivery_method = 'delivery';
    public  $value_increase_or_decrease = null;
    public  $type_increase_or_decrease = null;
    public ?float $amount = null;
    public ?bool $hasExchange = false;

    protected $listeners = [
        'cartItem::index::addToCart' => '$refresh',
        'cartItem::index::cleanCart' => '$refresh',
        'client::index::registered' => '$refresh',
    ];

    public function finish()
    {
        $client = Client::find($this->client_id);
        $user = Auth::user();

        $processing = new ProcessingCartItemsCheckout(
            $this->client_id,
            $this->paymentMethod,
            $this->type_increase_or_decrease,
            $this->value_increase_or_decrease
        );

        if (!$processing->verifyHasItemsCart()) {
            return $this->notification()->warning(
                'Ops!',
                'Seu Carrinho não tem items!'
            );
        }
        if (!$processing->verifyClientCanBuy()) {
            return $this->notification()->warning(
                'Erro!',
                'Esse cliente está impossibilitado de realizar compras a prazo no momento'
            );
        }

        $total_amount =  $processing->makeCalcIcreaseOrDecrease();
        $this->amount = (float)\Cart::subtotal();

        $address = $client->address()->first();

        (new ProcessingCheckout(
            $user->company,
            $user,
            $client,
            $address,
            $this->paymentMethod,
            $this->delivery_method,
            $this->hasExchange,
            $this->amount,
            $total_amount,
            $this->type_increase_or_decrease,
            $this->value_increase_or_decrease,
            $this->delivery_man_id
        ))->processing();

        $this->emit('cartItem::index::finishSale');
        $this->notification()->success(
            'Parabéns!',
            'Venda realizada com sucesso!'
        );

        $this->reset();
    }

    public function exportSummarySales()
    {
        return SalesController::export();
    }

    protected function getClients(): ?object
    {
        return Auth::user()->company->clients;
    }

    public function increment($rowId): void
    {
        $product = \Cart::get($rowId);
        $qty = $product->qty + 1;
        \Cart::update($rowId, $qty);
        $this->emit('cartItem::index::updateQuantityItemCart');
    }

    public function decrement($rowId): void
    {
        $product = \Cart::get($rowId);
        $qty = $product->qty - 1;
        \Cart::update($rowId, $qty);
        $this->emit('cartItem::index::updateQuantityItemCart');
    }

    public function remove($rowId): void
    {
        \Cart::remove($rowId);
        $this->emit('cartItem::index::removeItemCart');
        $this->emit('cartItem::index::addToCart');
    }

    public function clearCart(): void
    {
        \Cart::destroy();
        $this->emit('cartItem::index::cleanCart');
    }

    public function render(): View
    {
        return view('livewire.box-front.cart-items', ['items' => \Cart::content(), 'clients' => $this->getClients()]);
    }
}
