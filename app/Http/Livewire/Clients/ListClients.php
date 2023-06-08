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
                'clients::index::increase-or-decrease' => '$refresh',
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
        
        return $this->user->company->clients;
        
    }
    public function header(): array
    {
        return [
            Button::add('view')
                ->caption('Create new Client')
                ->class('inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150')
                ->openModal('clients.create', []),
            Button::add('view')
                ->caption('Increase and/or Decrease')
                ->class('inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150')
                ->openModal('clients.increase-or-decrease', []),
                
                
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
            ->addColumn('full_name')
            ->addColumn('group_formatted', function($entry){return $entry->groups->value('name');})
            ->addColumn('number_phone')
            ->addColumn('value_formatted',fn($entry) => "R$ ".number_format($entry->value,'2',',','.'))
            ->addColumn('payment_method_formatted', fn($entry) => $entry->payment_method =="" ? "UNINFORMED":  $entry->payment_method)
            ->addColumn('local_formatted', fn($entry) => $entry->local =="" ? "UNINFORMED":  $entry->local)
            ->addColumn('delivery_formatted', fn($entry) => $entry->delivery =="" ? "UNINFORMED":  $entry->delivery)
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
            Column::make('Name', 'full_name')->searchable()->sortable(),
            Column::make('Group', 'group_formatted')->searchable()->sortable(),
            Column::make('Number Phone', 'number_phone')->searchable()->sortable(),
            Column::make('Value', 'value_formatted')->sortable(),
            Column::make('Payment Method', 'payment_method_formatted')->sortable(),
            Column::make('Local', 'local_formatted')->sortable(),
            Column::make('Delivery', 'delivery_formatted')->sortable(),
            Column::make('Created', 'created_at_formatted'),
        ];
    }
    public function actions(): array
    {
        return [
            
            Button::add('view')
            ->caption('Delete')
            ->class('float-right inline-flex ml-4 items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150')
            ->openModal('clients.delete',['client' => 'id']),
            
            Button::add('view')
            ->caption('Update')
            ->class('float-right inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150')
            ->openModal('clients.update',['client' => 'id']),
        ];
    }
}
