<?php

namespace App\Http\Livewire\Clients;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class ListClients extends PowerGridComponent
{
    use ActionButton;
    public User $user;
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'clients::index::created' => '$refresh',
                'clients::index::deleted' => '$refresh',
                'clients::index::updated' => '$refresh',
            ]
        );
    }
    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function boot(): void
    {
        $this->user = Auth::user();
    }
    public function datasource(): ?Collection
    {
        return $this->user->company->users;
        
    }
    public function header(): array
    {
        return [
            Button::add('view')
                ->caption('Create new Group')
                ->class('inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150')
                ->openModal('clients.create', []),
                
                
        ];
    }
    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */
    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            
            Header::make()->withoutLoading(),
            Header::make()->showSearchInput(),
            Footer::make()->showPerPage()->showRecordCount(),
            
        ];
    }
    
    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('cpf')
            ->addColumn('group_formatted', function($entry){return $entry->groups->value('name');})
            ->addColumn('birthday_formatted', function($entry){return Carbon::parse($entry->birthday)->format('d/m/Y');})
            ->addColumn('number_phone')
            ->addColumn('number_phone_alternative_formatted',fn($entry) => $entry->number_phone_alternative == "" ? 'UNINFORMED': $entry->number_phone_alternative)
            ->addColumn('status_formatted', fn($entry) => $entry->status == true ? 'Enable': 'Disable')
            ->addColumn('created_at_formatted', function ($entry) {return Carbon::parse($entry->created_at)->format('d/m/Y');});
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |

    */
     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->searchable()->sortable(),
            Column::make('Name', 'name')->searchable()->sortable(),
            Column::make('CPF', 'cpf')->searchable()->sortable(),
            Column::make('Group', 'group_formatted')->searchable()->sortable(),
            Column::make('Birthday', 'birthday_formatted'),
            Column::make('Number Phone', 'number_phone')->searchable()->sortable(),
            Column::make('Number P. Alternative', 'number_phone_alternative_formatted')->sortable(),
            Column::make('Status', 'status_formatted')->sortable(),
            Column::make('Created', 'created_at_formatted'),
        ];
    }

}
