<?php

namespace App\Http\Livewire\Profiles;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Toggle extends Component
{
    public $user;
    public $profile;

    public function attach()
    {
        $this->user->profiles()->attach($this->profile);
        $this->emitTo(Users::class , 'users::index::attach');
    }
    public function detach()
    {
        $this->user->profiles()->detach($this->profile);
        $this->emitTo(Users::class , 'users::index::detach');
    }
    public function hasRelationship(): bool
    {   
        if($this->user){
            return $this->user->profiles->contains($this->profile);
        }
        return false;
    }
    public function render(): View
    {
        return view('livewire.profiles.toggle', ['has_relationship' => $this->hasRelationship()]);
    }
}
