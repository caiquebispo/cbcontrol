<?php

namespace App\Http\Livewire\Clients;

use App\Class\App\Sales;
use App\Models\Client;
use App\Models\User;
use App\Traits\Table\SettingTable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ShoppingList extends Component
{
    use Actions;
    use SettingTable;

    public Client $client;
    public User $user;

    public ?bool $showModal = false;

    protected $listeners = [
        'recevied::index::payment' => '$refresh',
    ];

    public function __construct()
    {
        $this->client = new Client;
        $this->user = Auth::user();
    }
    public function getOrders(): array
    {
        $orders = $this->client->orders()
            ->with('user', 'client', 'who_received', 'order_product.product')
            ->orderBy('orders.payment_status', 'DESC')
            ->get();

        return (new Sales)->getDataTableSales($orders);
    }
    public function render(): View
    {
        return view('livewire.clients.shopping-list', ['orders' => $this->getOrders()]);
    }
}
