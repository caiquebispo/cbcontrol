<?php

namespace App\Http\Livewire\Modules;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    public ?bool $showModal = false;
    public ?string $name = null;
    public ?string $label = null;
    public ?string $url = null;
    public ?string $menu_name = null;
    public ?string $icon_class = null;
    public ?string $order_list = null;
    public ?bool $is_module = null;

    protected array $rules = [
        'name' => ['required','string','min:4', 'max:256'],
        'label' => ['nullable','string','min:4', 'max:256'],
        'url' => ['nullable','string','min:4', 'max:256'],
        'menu_name' => ['nullable','string','min:4', 'max:256'],
        'icon_class' => ['nullable','string','min:4', 'max:256'],
        'order_list' => ['nullable','string','min:4', 'max:256'],
        'is_module' => ['boolean'],
    ];

    public function create(): void
    {
        $validated = $this->validate();
    }
    public function render(): View
    {
        return view('livewire.modules.create');
    }
}
