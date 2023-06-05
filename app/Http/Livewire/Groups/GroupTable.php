<?php

namespace App\Http\Livewire\Groups;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Group;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class GroupTable extends DataTableComponent
{
    public $selectedItems;
    public $canShowModal = false;
    public  ?string $name;

    protected $rules = [

        'name' => 'required|min:4|max:150'
    ];
    protected $listeners = [
        'groups::index::created' => '$refresh',
        'groups::index::delete' => '$refresh',
        'groups::index::updated' => '$refresh',
    ];

    public array $bulkActions = [

        'deleteSelected' => 'Delete',
        'updateSelected' => 'Update',
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setBulkActions([
            'deleteSelected' => 'Delete',
            'updateSelected' => 'Update',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("IDENTIFY", "id")->sortable(),
            Column::make("Name", "name")->sortable(),
            Column::make("Created at", "created_at")->format(fn ($value) => (new  DateTime($value))->format('d/m/Y'))->sortable(),
            Column::make("Updated at", "updated_at")->format(fn ($value) => (new  DateTime($value))->format('d/m/Y'))->sortable()
        ];
    }
    public function builder(): Builder
    {

        return Group::query()->where('company_id', Auth::user()->company_id);
    }
    public function bulkActions(): array
    {
        return [
            'deleteSelected' => 'Delete',
            'updateSelected' => 'Update',
        ];
    }
    public function deleteSelected()
    {
        Group::query()->where('company_id', Auth::user()->company_id)->whereIn('id', $this->getSelected())->delete();
        $this->clearSelected();
    }
    public function updateSelected()
    {   
        $this->selectedItems = Group::query()->where('company_id', Auth::user()->company_id)->whereIn('id', $this->getSelected())->first();
        $this->canShowModal = true;
        $this->emit('canShowModal', "livewire.groups.update", ['selectedItems' => $this->selectedItems]);
        
    }
    public function customView(): string
    {
        return 'livewire.groups.update';
    }

    public function update(){

        $validated = $this->validate();
        Group::query()->where('company_id', Auth::user()->company_id)->whereIn('id', $this->getSelected())->update($validated);
        $this->clearSelected();
        $this->canShowModal = false;
    }
}
