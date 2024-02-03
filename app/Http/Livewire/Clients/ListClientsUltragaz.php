<?php

namespace App\Http\Livewire\Clients;

use App\Http\Controllers\ClientController;
use App\Models\User;
use App\Traits\Table\SettingTable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListClientsUltragaz extends Component
{
    use SettingTable;
    use WithPagination;

    public User $user;

    protected $listeners = [
        'client::index::created' => '$refresh',
        'client::index::updated' => '$refresh',
        'client::index::deleted' => '$refresh',
        'client:index::increase-or-decrease' => '$refresh',
    ];

    public function mount(): void
    {
        $this->user = Auth::user();
    }
    protected function getClients()
    {

        return $this->user->company->clients()
            ->when($this->search != '', fn ($query) => $query->where('full_name', 'like', '%' . $this->search . '%'))
            ->orderBy($this->setSortField(), $this->sortDirection)
            ->paginate($this->qtyItemsForPage);
    }

    public function exportPDF($model)
    {
        return ClientController::exportPDF();
    }
    public function render(): View
    {
        return view('livewire.clients.list-clients-ultragaz', ['clients' => $this->getClients()]);
    }
}
