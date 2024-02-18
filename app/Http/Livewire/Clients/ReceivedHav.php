<?php

namespace App\Http\Livewire\Clients;

use App\Models\Order;
use App\Models\OrderHav;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class ReceivedHav extends Component
{
    use Actions;
    public ?bool $showModal = false;
    public ?int $order_id = null;
    public ?object $order = null;
    public ?float $value = null;

    public function received(): void
    {
        $this->order = Order::findOrFail($this->order_id);

        $this->order->order_hav()->create([
            'day' => now()->format('Y-m-d H:i:s'),
            'value' => $this->value,
            'received_id' => Auth::user()->id,
        ]);
        if ($this->order->order_hav()->sum('value') === $this->order->total_amount) {
            $this->order->update(['payment_status' => 'confirmed']);
        }
        $this->emit('recevied::index::payment');
        $this->notifications();
        $this->reset();
    }
    public function notifications(): void
    {

        $this->notification()->success(
            'HAV!',
            'Pagamento hav com sucesso!'
        );
        foreach (Auth::user()->company->users as $user) {

            $notification = new \MBarlow\Megaphone\Types\Important(
                'HAV!',
                'O cliente ' . $this->order->client->full_name . ' acaba de dar uma hav para o usuário ' . Auth::user()->name

            );
            $user->notify($notification);
        }
    }
    public function render(): View
    {
        return view('livewire.clients.received-hav');
    }
}
