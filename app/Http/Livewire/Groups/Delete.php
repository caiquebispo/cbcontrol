<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
class Delete extends ModalComponent
{
    public Group $group;

    public function __construct()
    {
        $this->group = new Group();
    }
    public function render()
    {
        return view('livewire.groups.delete');
    }
    public function delete():void
    {
        // dd($this->group);
        $this->group->delete();
        $this->reset();
        $this->emitTo(ListGroups::class, 'groups::index::deleted');
        $this->closeModal();
    }
}
