<?php

namespace App\Http\Livewire\Groups;

use App\Traits\Table\SettingTable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListGroup extends Component
{
    use SettingTable;
    use WithPagination;

    protected $listeners = [
        'group::index::created' => '$refresh',
        'group::index::deleted' => '$refresh',
        'group::index::updated' => '$refresh',
    ];

    public function render(): View
    {
        return view('livewire.groups.list-group', ['groups' => $this->getGroups()]);
    }

    public function getGroups(): object
    {
        return Auth::user()->company->groups()
            ->when($this->search != '', fn ($query) => $query->where('name', 'like', '%'.$this->search.'%'))
            ->orderBy($this->setSortField('name'), $this->sortDirection)
            ->paginate($this->qtyItemsForPage);
    }
}
