<?php

namespace App\Http\Livewire\Clients;

use App\Models\Client;
use App\Models\User;
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
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class ListClients extends PowerGridComponent
{
    use ActionButton;
    public User $user;
    public Client $clients;

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
                ->caption('Cadastrar Cliente')
                ->class('inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150')
                ->openModal('clients.create', []),
            Button::add('view')
                ->caption('Acréscimo / Decréscimo')
                ->class('inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150')
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
            Column::make('Nome', 'full_name')->searchable()->sortable(),
            Column::make('Grupo', 'group_formatted')->searchable()->sortable(),
            Column::make('Nª Telefone', 'number_phone')->searchable()->sortable(),
            Column::make('Valor', 'value_formatted')->sortable(),
            Column::make('Forma de Pagamento', 'payment_method_formatted')->sortable(),
            Column::make('Local', 'local_formatted')->sortable(),
            Column::make('Entrega', 'delivery_formatted')->sortable(),
            Column::make('Criando em', 'created_at_formatted'),
        ];
    }
    public function actions(): array
    {
        return [
            
            Button::add('button-trash')
            ->render(function (Client $client) {
                return Blade::render(<<<HTML
                <x-button-trash primary icon="pencil" onclick="Livewire.emit('openModal', 'clients.delete', {{ json_encode(['client' => $client->id]) }})" />
                HTML);
            }),
            Button::add('button-update')
            ->render(function (Client $client) {
                return Blade::render(<<<HTML
                <x-button-update primary icon="pencil" onclick="Livewire.emit('openModal', 'clients.update', {{ json_encode(['client' => $client->id]) }})" />
                HTML);
            }),
            
        ];
    }
    
}
