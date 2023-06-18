<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Delete extends ModalComponent
{
    use Actions;
    public Group $group;

    public function __construct()
    {
        $this->group = new Group();
    }
    public function render(): View
    {
        return view('livewire.groups.delete');
    }
    public function delete():void
    {
        
        $this->group->delete();
        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Grupo Deletado com sucesso!'
        ); 
        $this->reset();
        $this->emitTo(ListGroups::class, 'groups::index::deleted');
        $this->closeModal();
    }
}
