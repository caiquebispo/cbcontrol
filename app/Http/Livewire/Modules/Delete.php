<?php

namespace App\Http\Livewire\Modules;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Delete extends Component
{
    public ?bool $showModal = false;
    public $module;

    public function delete(): void
    {
        $this->module->delete();
        $this->emitTo(ListModules::class, 'module::index::deleted');
        $this->reset();
    }
    public function render(): View
    {
        return view('livewire.modules.delete');
    }
}
