<?php

namespace App\Http\Livewire\Modules;

use App\Models\Module;
use App\Traits\Table\SettingTable;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ListModules extends Component
{
    use SettingTable;
    protected  $listeners = [

        'module::index::created' => '$refresh',
        'module::index::deleted' => '$refresh',
        'module::index::updated' => '$refresh',
    ];
    public function getModules(): object
    {
        
        return Module::when($this->search != "", fn($query) => $query->where('name', 'like', '%'.$this->search."%"))
            ->orderBy($this->setSortField('menu_name'), $this->sortDirection)
            ->paginate($this->qtyItemsForPage);
    }
    public function render(): View
    {
        return view('livewire.modules.list-modules',['modules' => $this->getModules()]);
    }
    
}
