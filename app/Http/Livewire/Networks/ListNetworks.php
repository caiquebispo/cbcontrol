<?php

namespace App\Http\Livewire\Networks;

use App\Traits\Table\SettingTable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListNetworks extends Component
{
    use SettingTable;
    use WithPagination;

    protected $listeners = [
        'network::index::created' => '$refresh',
        'network::index::deleted' => '$refresh',
        'network::index::updated' => '$refresh',
    ];

    public function render(): View
    {
        return view('livewire.networks.list-networks', ['networks' => $this->getNetworks()]);
    }

    public function getNetworks(): object
    {
        return Auth::user()->networks()
            ->when($this->search != '', fn ($query) => $query->where('name', 'like', '%'.$this->search.'%'))
            ->orderBy($this->setSortField('name'), $this->sortDirection)
            ->paginate($this->qtyItemsForPage);
    }
}
