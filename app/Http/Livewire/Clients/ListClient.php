<?php

namespace App\Http\Livewire\Clients;

use App\Http\Controllers\ClientController;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListClient extends Component
{
    use WithPagination;
    public ?string $search = '';
    public ?int $qtyItemsForPage = 10;
    public User $user;
    public ?string $sortField = 'full_name';
    public ?string $sortDirection = 'asc';

    protected $listeners = [
        'client::index::created' => '$refresh',
        'client::index::updated' => '$refresh',
        'client::index::deleted' => '$refresh',
    ];
    public function mount(): void
    {
        $this->user = Auth::user();
    }

    public function render(): View
    {
        return view('livewire.clients.list-client', ['clients' => $this->getClients()]);
    }
    public function sortBy($field): void
    {

        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';
        $this->sortField = $field;
    }
    protected function getClients(){

        return $this->user->company->clients()
            ->when($this->search != "", fn($query) => $query->where('full_name', 'like', '%'.$this->search."%"))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->qtyItemsForPage);
    }
    public function  exportPDF($model): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return ClientController::exportPDF();
    }
}
