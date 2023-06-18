<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Update extends ModalComponent
{
    use Actions;
    public Group $group;

    public ?string $name = null;

    protected $rules = [

        'group.name' => 'required|min:4|max:150'
    ];
    public function __construct()
    {
        $this->group = new Group;
    }
    public function render(): View
    {
        return view('livewire.groups.update');
    }
    public function update(): void
    {
        $this->validate();
        $this->group->save();

        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Grupo Editado com sucesso!'
        ); 
        $this->reset();
        $this->emitTo(ListGroups::class, 'groups::index::updated');
        $this->closeModal();
    }
}
