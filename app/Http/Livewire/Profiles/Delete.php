<?php

namespace App\Http\Livewire\Profiles;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Delete extends Component
{
    public ?bool $showModal = false;
    public ?object $profile;

    public function delete(): void
    {
        dd('is here');
    }
    public function render(): View
    {
        return view('livewire.profiles.delete');
    }
}
