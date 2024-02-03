<?php

namespace App\Http\Livewire\BoxFront;

use App\Class\App\Sales;
use App\Class\Store\Checkout\ProcessingCheckout;
use App\Http\Controllers\SalesController;
use App\Models\Client;
use DateTime;
use PDF;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class CartItems extends Component
{
    use Actions;
    public ?int $client_id;
    public ?string $paymentMethod = '';
    public ?string $delivery_method = '';
    public ?float $amount = null;
    public ?bool $hasExchange = false;

    protected $listeners = [
        'cartItem::index::addToCart' => '$refresh',
        'cartItem::index::cleanCart' => '$refresh',
        'client::index::registered' => '$refresh',
    ];
    public function finish()
    {
        if (count(\Cart::content()) > 0) {

            $client = Client::find($this->client_id);
            $address = $client->address()->first();
            (new ProcessingCheckout(Auth::user()->company, Auth::user(), $client, $address, $this->paymentMethod, $this->delivery_method, $this->hasExchange, \Cart::subtotal()))->processing();
            $this->emit('cartItem::index::finishSale');
            // $this->reset();
            $this->notification()->success(
                'Parabéns!',
                'Venda realizada com sucesso!'
            );
        } else {
            $this->notification()->error(
                'Ops!',
                'Seu Carrinho não tem items!'
            );
        }
    }
    public function exportSummarySales()
    {
        return SalesController::export();
    }
    protected function getClients(): null|object
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
