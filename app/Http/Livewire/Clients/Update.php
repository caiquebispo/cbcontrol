<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class Update extends Component
{
    use Actions;

    public Client $client;
    public  $address;
    public ?bool $showModal = false;

    public ?int $step = 1;
    public ?array $user = [];
    public $address_data = [];

    public function mount(): void
    {
        $this->address = $this->client->address()->first();
    }
    public function rules(): array
    {

        return [

            'client.full_name' => 'required|min:3',
            'client.email' => 'nullable|email',
            'client.number_phone' => 'nullable|string|min:4|unique:clients,number_phone,' . $this->client->id,
            'client.birthday' => 'nullable|date',
            'client.group_id' => 'nullable',
            'address.states' => 'required|max:150',
            'address.zipe_code' => 'required',
            'address.city' => 'required',
            'address.neighborhood' => 'required',
            'address.road' => 'required',
            'address.number' => 'nullable',
            'address.complement' => 'nullable',

        ];
    }
    public function nextStep(): void
    {
        match ($this->step) {
            1 => $this->validateDataUser(),
            2 => $this->validateAddressUser(),
            default => $this->step++,
        };

        if ($this->step < 2) {
            $this->step++;
        } else {

            $this->client->update($this->user['client']);
            $this->address->update($this->address_data['address']);

            $this->notification()->success(
                'Parabéns!',
                'Cliente Editado com sucesso!'
            );
            $this->emit('client::index::updatedaux');
            $this->showModal = false;
        }
    }

    public function previousStep(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function resetCheckoutField(): void
    {
        $this->reset();
    }

    public function validateDataUser(): void
    {

        $this->user = $this->validate([
            'client.full_name' => 'required|min:3',
            'client.email' => 'nullable|email',
            'client.group_id' => 'nullable',
            'client.number_phone' => 'required',
            'client.birthday' => 'nullable|date',
        ]);
    }

    public function validateAddressUser(): void
    {

        $this->address_data = $this->validate([
            'address.states' => 'required|max:150',
            'address.zipe_code' => 'required',
            'address.city' => 'required',
            'address.neighborhood' => 'required',
            'address.road' => 'required',
            'address.number' => 'nullable',
            'address.complement' => 'nullable',
        ]);
    }

    public function render(): View
    {
        $groups = Auth::user()->company->groups;
        return view('livewire.clients.update', compact('groups'));
    }
}
