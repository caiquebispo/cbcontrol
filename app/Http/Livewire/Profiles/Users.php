<?php

namespace App\Http\Livewire\Profiles;

use App\Models\User;
use App\Traits\Table\SettingTable;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Users extends Component
{
    use SettingTable;
    public ?bool $showModal = false;
    public $profile;

    protected $listeners = [
        
        'users::index::attach' => '$refresh',
        'users::index::detach' => '$refresh',
    ];

    public function getUsers(): object
    {
        return User::when($this->search != "", fn($query) => $query->where('name', 'like', '%'.$this->search."%"))
            ->where('status', true)
            ->orderBy($this->setSortField('name'), $this->sortDirection)
            ->paginate($this->qtyItemsForPage);
    }
    public function render(): View
    {
        return view('livewire.profiles.users', ['users' => $this->getUsers(), 'profile' => $this->profile]);
    }
}
