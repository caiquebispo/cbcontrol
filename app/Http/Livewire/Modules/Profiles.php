<?php

namespace App\Http\Livewire\Modules;

use App\Models\Profile;
use App\Traits\Table\SettingTable;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Profiles extends Component
{   
    use SettingTable;
    public ?bool $showModal = false;
    public $module;

    protected $listeners = [
        
        'profile::index::attach' => '$refresh',
        'profile::index::detach' => '$refresh',
    ];

    public function getProfiles(): object
    {
        return Profile::when($this->search != "", fn($query) => $query->where('name', 'like', '%'.$this->search."%"))
            ->orderBy($this->setSortField('name'), $this->sortDirection)
            ->paginate($this->qtyItemsForPage);
    }
    public function render(): View
    {
        return view('livewire.modules.profiles', ['profiles' => $this->getProfiles(), 'module' => $this->module]);
    }
}
