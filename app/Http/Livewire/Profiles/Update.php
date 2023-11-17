<?php

namespace App\Http\Livewire\Profiles;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use WireUi\Traits\Actions;

class Update extends Component
{
    use Actions;
    public $profile;
    public ?bool $showModal = false;
    
    public function rules()
    {
        return [
            'profile.name' =>  'required|string|min:4|max:256|unique:profiles,name,' . $this->profile->name,
        ];
    }
    
    public function update(): void
    {
        $this->validate();
        $this->profile->save();
        $this->emitTo(ListProfiles::class, 'profiles::index::updated');
        $this->notifications();
        
    }
    public function notifications(){

        $this->notification()->success(
            'Parabéns!',
            'Você atualizou as inforamções do perfil!'
        ); 
    }
    public function render(): View
    {
        return view('livewire.profiles.update');
    }
}
