<?php

namespace App\Http\Livewire\Networks;

use App\Models\Network;
use App\Traits\Table\SettingTable;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Update extends Component
{
    use WithPagination;
    use SettingTable;

    public ?bool $showModal = false;
    public ?Network $network;

    public  function mount( Network $network): void
    {
        $this->network = $network;
    }

    public function render(): View
    {
        return view('livewire.networks.update',
            [
                'companies' => $this->getCompanies(),
                'users' => $this->getUsers()
            ]
        );
    }
    protected function getCompanies(): object
    {

        return $this->network->companies()->when($this->search != "", fn($query) => $query->where('corporate_reason', 'like', '%'.$this->search."%"))
            ->orderBy($this->setSortField('corporate_reason'), $this->sortDirection)
            ->paginate($this->qtyItemsForPage);
    }
    protected function getUsers(): object
    {

        return $this->network->users()->when($this->search != "", fn($query) => $query->where('corporate_reason', 'like', '%'.$this->search."%"))
            ->orderBy($this->setSortField('name'), $this->sortDirection)
            ->paginate($this->qtyItemsForPage);
    }
}
