<?php

namespace App\Http\Livewire\SettingsCompany;

use App\Models\SettingCompany;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class Settings extends Component
{

    use Actions;
    public ?SettingCompany $settings;
    public ?string $slung = null;
    public ?string $primary_color = null;
    public ?string $second_color = null;
    public ?bool $is_opened = null;
    public ?bool $has_delivery = null;
    public ?float $delivery_price = null;

    public function rules(): array
    {
        return [
            'settings.slung' => 'required|min:4|max:150',
            'settings.primary_color' => 'nullable',
            'settings.second_color' => '',
            'settings.font_color' => 'nullable',
            'settings.is_opened' => 'required',
            'settings.has_delivery' => 'required',
            'settings.delivery_price' => 'nullable',
        ];
    }
    public function mount(): void
    {
        $this->settings = Auth::user()->company->settings;
    }
    public function render():View
    {
        return view('livewire.settings-company.settings');
    }
    public function update():void
    {
        $this->validate();
        $this->settings->save();
        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Aterações realizadas com sucesso!'
        );

    }
    public function toCleanPaletteColors(): void
    {
        $this->settings->update(['primary_color' => '','second_color' => '','font_color' => '']);
        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Aterações realizadas com sucesso!'
        );
    }
}
