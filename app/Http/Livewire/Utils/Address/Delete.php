<?php

namespace App\Http\Livewire\Utils\Address;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

use Livewire\Component;
use WireUi\Traits\Actions;

class Delete extends Component
{
    use Actions;
    public Address $address;

    public function render(): View
    {
        return view('livewire.utils.address.delete');
    }

    public function delete():void
    {
        $this->address->delete();
        $this->emit('address::index::deleted');
        $this->notifications();
    }
    public function notifications(){

        $this->notification()->success(
            $title = 'Parabéns!',
            $description =  'Endereço deletado com sucesso!'
        ); 
        foreach(Auth::user()->company->users as $user){
            
            $notification = new \MBarlow\Megaphone\Types\Important(
                'Remoção de Usuário!',
                'O usuário(a) '.Auth::user()->name.' deletou um usuário na empresa '.Auth::user()->company->corporate_reason,
                
            );
            $user->notify($notification);
        }
    }
}
