<?php

namespace App\Http\Livewire\Profiles;

use Livewire\Component;

class Create extends Component
{
    public ?bool $showModal = false;
    public ?string $name = null;

    protected array $rules = [
        'name' => ['required', 'unique:profiles', 'min:4', 'max:256']
    ];

    public function create(): void
    {
        $validated = $this->validate();
    }
    public function render()
    {
        return view('livewire.profiles.create');
    }
}
