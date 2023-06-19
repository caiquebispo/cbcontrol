<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Update extends ModalComponent
{
    use Actions;
    public Group $group;
    public User $user;

    public ?string $name = null;

    protected $rules = [

        'group.name' => 'required|min:4|max:150'
    ];
    public function __construct()
    {
        $this->group = new Group;
        $this->user = Auth::user();
    }
    public function render(): View
    {
        return view('livewire.groups.update');
    }
    public function update(): void
    {
        $this->validate();
        $this->group->save();

        $this->notifications(); 
        $this->reset();
        $this->emitTo(ListGroups::class, 'groups::index::updated');
        $this->closeModal();
    }
    public function notifications(){

        $this->notification()->success(
            $title = 'Parabéns!',
            $description =  'Grupo Editado com sucesso!'
        ); 
        foreach($this->user->company->users as $user){
            
            $notification = new \MBarlow\Megaphone\Types\General(
                'Atualização de Grupo!',
                'O usuário(a) '.$this->user->name.' editou as informações de um grupo na empresa '.$this->user->company->corporate_reason,
                
            );
            $user->notify($notification);
        }
    }
}
