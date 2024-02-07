<?php

namespace App\Http\Livewire\Clients;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class ReceviedPayment extends Component
{
    use Actions;
    public ?int $order_id = null;
    public ?object $order = null;

    public function getReceviedPayment()
    {
        $this->order = Order::findOrFail($this->order_id);

        $this->order->update([
            'who_received_id' => Auth::user()->id,
            'received_day' => now()->format('Y-m-d'),
            'payment_status' => 'confirmed',
        ]);

        $this->emit('recevied::index::payment');
        $this->notifications();
    }
    public function notifications(): void
    {

        $this->notification()->success(
            'Recebido!',
            'Pagamento recebido com sucesso!'
        );
        foreach (Auth::user()->company->users as $user) {

            $notification = new \MBarlow\Megaphone\Types\Important(
                'Recebido!',
                'O cliente ' . $this->order->client->full_name . ' acaba de realizar um pagamento para o usuário ' . Auth::user()->name

            );
            $user->notify($notification);
        }
    }
    public function render(): View
    {
        return view('livewire.clients.recevied-payment');
    }
}
