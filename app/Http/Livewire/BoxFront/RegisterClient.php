<?php

namespace App\Http\Livewire\BoxFront;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class RegisterClient extends Component
{
    use Actions;

    public ?bool $showModal = false;

    public ?int $step = 1;

    public ?array $user = [];

    public $address = [];

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

            $full_name = ['full_name' => Arr::only($this->user['user'], ['name'])['name']];
            $data = array_merge($full_name, Arr::except($this->user['user'], ['password_confirm', 'name']));
            $user = Auth::user()->company->clients()->create($data);
            $address = is_string($this->address) ? collect(json_decode($this->address, true)) : $user->address()->create($this->address['address']);

            $this->resetCheckoutField();
            $this->notification()->success(
                'Parabéns!',
                'Cliente Cadastrado com sucesso!'
            );
            $this->emit('client::index::registered');
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
            'user.name' => 'required|min:3',
            'user.email' => 'nullable|email',
            'user.number_phone' => 'required',
            'user.password' => 'required|min:8|max:16',
            'user.password_confirm' => 'required|min:8|max:16|same:user.password',
        ]);
    }

    public function validateAddressUser(): void
    {

        $this->address = $this->validate([
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
        return view('livewire.box-front.register-client');
    }
}
