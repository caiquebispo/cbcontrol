<?php

namespace App\Http\Livewire\Modules;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;

class Toggle extends Component
{
    use Actions;
    public $module;
    public $profile;

    public function attach()
    {
        $this->module->profiles()->attach($this->profile);
        $this->emitTo(Profiles::class , 'profile::index::attach');
    }
    public function detach()
    {
        $this->module->profiles()->detach($this->profile);
        $this->emitTo(Profiles::class , 'profile::index::detach');
    }
    public function hasRelationship(): bool
    {
        return $this->module->profiles->contains($this->profile);
    }
    public function render(): View
    {
        return view('livewire.modules.toggle', ['has_relationship' => $this->hasRelationship()]);
    }
}
