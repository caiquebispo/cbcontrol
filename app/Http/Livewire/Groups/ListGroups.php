<?php

namespace App\Http\Livewire\Groups;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListGroups extends Component
{
    public User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function render(): View
    {
        return view('livewire.groups.list-groups', ['groups' => $this->user->company->groups]);
    }
}
