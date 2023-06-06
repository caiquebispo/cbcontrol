<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Rules\Rule;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;


final class ListGroups extends PowerGridComponent
{
    use ActionButton;



    public User $user;
    
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'groups::index::created' => '$refresh',
                'groups::index::deleted' => '$refresh',
                'groups::index::updated' => '$refresh',
            ]
        );
    }
    public function boot()
    {
        $this->user = Auth::user();
    }
    public function datasource(): EloquentCollection
    {

        return $this->user->company->groups;
    }
    public function header(): array
    {
        return [
            Button::add('view')
                ->caption('Create new Group')
                ->class('inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150')
                ->openModal('groups.create', []),
                
        ];
    }
    
    public function setUp(): array
    {
        return [
            Header::make()
             ->showSearchInput(),
            Header::make()->withoutLoading(),
            Header::make()->showToggleColumns(),
            Footer::make()->showPerPage()->showRecordCount(),
        ];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('created_at_formatted', function ($entry) {
                return Carbon::parse($entry->created_at)->format('d/m/Y');
            });
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->searchable()->sortable(),
            Column::make('Name', 'name')->searchable()->sortable(),
            Column::make('Created', 'created_at_formatted')->searchable()->sortable(),
            

            
        ];
    }

    public function actions(): array
    {
        return [
            
            Button::add('view')
            ->caption('Delete')
            ->class('float-right inline-flex ml-4 items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150')
            ->openModal('groups.delete',['group' => 'id']),
            
            Button::add('view')
            ->caption('Update')
            ->class('float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150')
            ->openModal('groups.update',['group' => 'id']),
        ];
    }
}
