<?php

namespace App\Http\Livewire\Groups;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public User $user;
    public bool $canShowModal = false;
    public ?string $name = null;
    
    protected $rules = [

        'name' => 'required|min:4|max:150'
    ];

    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function render(): View
    {
        return view('livewire.groups.create');
    }
    public function create(): void
    {
        $validated = $this->validate();
        $this->user->company->groups()->updateOrCreate($validated,$validated);
        $this->reset();
        $this->emitTo(GroupTable::class, 'groups::index::created');
    }
    
}
