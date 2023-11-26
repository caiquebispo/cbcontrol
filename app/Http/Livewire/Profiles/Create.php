<?php

namespace App\Http\Livewire\Profiles;

use App\Models\Profile;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;
    public ?bool $showModal = false;
    public ?string $name = null;

    protected array $rules = [
        'name' => ['required', 'unique:profiles', 'min:4', 'max:256']
    ];

    public function create(): void
    {
        $validated = $this->validate();
        Profile::create($validated);
        $this->emitTo(ListProfiles::class, 'profiles::index::created');
        $this->reset();
        $this->notifications();
    }
    public function notifications(): void
    {
        $this->notification()->success(
            'Parabéns!',
            'Perfil Cadastrado com sucesso!'
        );
    }
    public function render(): View
    {
        return view('livewire.profiles.create');
    }
}
