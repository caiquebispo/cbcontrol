<?php

namespace App\Http\Livewire\Profiles;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;

class Delete extends Component
{
    use Actions;
    public ?bool $showModal = false;
    public $profile;

    public function delete(): void
    {
        
        $this->profile->delete();
        $this->emitTo(ListProfiles::class, 'profiles::index::deleted');
        $this->reset();
        $this->notifications();
    }
    public function notifications(): void
    {
        $this->notification()->success(
            'Parabéns!',
            'Perfil Deletado com sucesso!'
        );
    }
    public function render(): View
    {
        return view('livewire.profiles.delete');
    }
}
