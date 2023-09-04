<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListClient extends Component
{
    use WithPagination;
    public ?string $search = '';
    public User $user;
    protected $listeners = [
        'client::index::created' => '$refresh',
        'client::index::updated' => '$refresh',
    ];
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function render(): View
    {
        return view('livewire.clients.list-client', ['clients' => $this->getClients()]);
    }
    protected function getClients(){

        return $this->user->company->clients()
            ->when($this->search != "", fn($query) => $query->where('full_name', 'like', '%'.$this->search."%"))
            ->paginate(10);
    }
}
