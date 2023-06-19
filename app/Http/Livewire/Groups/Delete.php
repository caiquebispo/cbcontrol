<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Delete extends ModalComponent
{
    use Actions;
    public Group $group;
    public User $user;

    public function __construct()
    {
        $this->group = new Group();
        $this->user = Auth::user();
    }
    public function render(): View
    {
        return view('livewire.groups.delete');
    }
    public function delete():void
    {
        
        $this->group->delete();
        $this->notifications();
        $this->reset();
        $this->emitTo(ListGroups::class, 'groups::index::deleted');
        $this->closeModal();
    }
    public function notifications(){

        $this->notification()->success(
            $title = 'Parabéns!',
            $description =   'Grupo Deletado com sucesso!'
        ); 
        foreach($this->user->company->users as $user){
            
            $notification = new \MBarlow\Megaphone\Types\Important(
                'Remoção de Grupo!',
                'O usuário(a) '.$this->user->name.' deletou um grupo na empresa '.$this->user->company->corporate_reason,
                
            );
            $user->notify($notification);
        }
    }
}
