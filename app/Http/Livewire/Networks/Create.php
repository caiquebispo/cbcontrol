<?php

namespace App\Http\Livewire\Networks;

use App\Events\StorageNetwork;
use App\Models\Network;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;

    public ?string $name = null;

    public ?bool $showModal = false;

    protected array $rules = [

        'name' => 'required|min:4|max:150|unique:networks',
    ];

    public function render(): View
    {
        return view('livewire.networks.create');
    }

    public function create(): void
    {

        $validated = $this->validate();

        $network = Network::create($validated);
        StorageNetwork::dispatch($network);
        $this->reset();
        $this->emitTo(ListNetworks::class, 'network::index::created');
        $this->notifications();
    }

    public function notifications(): void
    {

        $this->notification()->success(
            'Parabéns!',
            'Rede Criado com sucesso!'
        );

    }
}
