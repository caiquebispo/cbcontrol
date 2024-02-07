<?php

namespace App\Http\Livewire\Users;

use App\Traits\Table\SettingTable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use SettingTable;
    use WithPagination;

    protected $listeners = [
        'users::index::created' => '$refresh',
        'users::index::deleted' => '$refresh',
        'users::index::updated' => '$refresh',
        'users::index::updated-password' => '$refresh',
    ];

    public function render(): View
    {
        return view('livewire.users.list-users', ['users' => $this->getUsers()]);
    }

    public function getUsers(): object
    {
        return Auth::user()->company->users()
            ->when($this->search != '', fn ($query) => $query->where('name', 'like', '%'.$this->search.'%'))
            ->orderBy($this->setSortField('name'), $this->sortDirection)
            ->paginate($this->qtyItemsForPage);
    }
}
