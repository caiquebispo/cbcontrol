<?php

namespace App\Http\Livewire\Groups;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Group;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class GroupTable extends DataTableComponent
{

    protected $listeners = [
        'groups::index::created' => '$refresh',
        'groups::index::delete' => '$refresh',
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
        foreach ($this->getSelected() as $item) {
            Group::query()->where('company_id', Auth::user()->company_id)->where('id', $item)->delete();
        }
        $this->clearSelected();
    }
}
