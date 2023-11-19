<?php

namespace App\Http\Livewire\Modules;

use App\Models\Module;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Update extends Component
{
    public object $module;
    public ?bool $showModal = false;
    public ?string $name = null;
    public ?string $label = null;
    public ?string $url = null;
    public ?string $menu_name = null;
    public ?string $icon_class = null;
    public ?bool $order_list = null;
    public ?bool $is_module = null;

    protected array $rules = [

        'module.name' => ['required','string','min:4', 'max:256'],
        'module.label' => ['nullable','string','min:4', 'max:256'],
        'module.url' => ['nullable','string','min:4', 'max:256'],
        'module.menu_name' => ['nullable','string','min:4', 'max:256'],
        'module.icon_class' => ['nullable','string','min:4', 'max:256'],
        'module.order_list' => ['nullable','bool'],
        'module.is_module' => ['bool'],
    ];

    public function update(): void
    {
        $this->validate();
        $this->module->save();
        $this->emitTo(ListModules::class, 'module::index::updated');
    }
    public function render(): View
    {
        return view('livewire.modules.update');
    }

}
