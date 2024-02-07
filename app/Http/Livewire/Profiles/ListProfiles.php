<?php

namespace App\Http\Livewire\Profiles;

use App\Models\Profile;
use App\Traits\Table\SettingTable;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ListProfiles extends Component
{
    use SettingTable;

    protected $listeners = [
        'profiles::index::created' => '$refresh',
        'profiles::index::deleted' => '$refresh',
        'profiles::index::updated' => '$refresh',
    ];

    public function render(): View
    {
        return view('livewire.profiles.list-profiles', ['profiles' => $this->getProfiles()]);
    }

    public function getProfiles(): object
    {
        return Profile::when($this->search != '', fn ($query) => $query->where('name', 'like', '%'.$this->search.'%'))
            ->orderBy($this->setSortField('name'), $this->sortDirection)
            ->paginate($this->qtyItemsForPage);
    }
}
