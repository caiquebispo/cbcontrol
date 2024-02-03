<?php

namespace App\Http\Livewire\BoxFront;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListClients extends Component
{
    public  $client_id;
    protected $listeners = ['client::index::registered' => '$refresh'];
    public function change()
    {
        $this->emitTo(CartItems::class, 'test({{$this->id}})');
    }

    protected function getClients(): null|object
    {
        return Auth::user()->company->clients;
    }
    public function render(): View
    {
        return view('livewire.box-front.list-clients', ['clients' => $this->getClients()]);
    }
}
