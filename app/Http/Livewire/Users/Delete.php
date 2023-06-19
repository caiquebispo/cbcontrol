<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Delete extends ModalComponent
{
    use Actions;
    public User $user;
    public function __construct()
    {
        
        $this->user = new User;
    }
    public function render()
    {
        return view('livewire.users.delete');
    }
    public function delete():void
    {
        $this->user->delete();
        $this->notifications();
        $this->reset();
        $this->emitTo(ListUsers::class, 'users::index::deleted');
        $this->closeModal();
    }
    public function notifications(){

        $this->notification()->success(
            $title = 'Parabéns!',
            $description =  'Usuário Deletado com sucesso!'
        ); 
        foreach(Auth::user()->company->users as $user){
            
            $notification = new \MBarlow\Megaphone\Types\Important(
                'Remoção de Usuário!',
                'O usuário(a) '.Auth::user()->name.' deletou um usuário na empresa '.$this->user->company->corporate_reason,
                
            );
            $user->notify($notification);
        }
    }
}
