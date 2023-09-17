<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class Delete extends Component
{
    use Actions;
    public Client $client;
    public User $user;
    public ?bool $showModal = false;
    public function __construct()
    {
        $this->client = new Client;
        $this->user = Auth::user();
    }
    public function render()
    {
        return view('livewire.clients.delete');
    }
    public function delete():void
    {

        $this->client->delete();
        $this->notifications();
        $this->reset();
        $this->emitTo(ListClient::class, 'client::index::deleted');
    }
    public function notifications(){

        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Cliente Deletado com sucesso!'
        );
        foreach($this->user->company->users as $user){

            $notification = new \MBarlow\Megaphone\Types\Important(
                'Remoção de cliente!',
                'O usuário(a) '.$this->user->name.' deletou um cliente na empresa '.$this->user->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
