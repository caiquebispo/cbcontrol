<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Detail;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class ListUsers extends PowerGridComponent
{
    use ActionButton;
    public User $user;
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'users::index::created' => '$refresh',
                'users::index::deleted' => '$refresh',
                'users::index::updated' => '$refresh',
                'users::index::updated-password' => '$refresh',
                'address::index::deleted' => '$refresh',
                'address::index::created' => '$refresh',
                'address::index::updated' => '$refresh',
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

    public function boot()
    {
        $this->user = Auth::user();
    }
    public function datasource(): ?Collection
    {
        return $this->user->company->users;
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */
    public function header(): array
    {
        return [
            Button::add('view')
                ->caption('Cadastrar Usuário')
                ->class('inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150')
                ->openModal('users.create', []),
                
        ];
    }
    public function setUp(): array
    {
        
        return [

            Detail::make()->view('livewire.utils.address.show')->showCollapseIcon(),
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
            ->addColumn('email')
            ->addColumn('number_phone', fn($entry) => $entry->number_phone != null ? $entry->number_phone : 'NAO CADASTRADO')
            ->addColumn('birthday_at_formatted', fn($entry) => $entry->birthday != null ? Carbon::parse($entry->birthday)->format('d/m/Y') : 'NAO CADASTRADO'  )
            ->addColumn('company', fn($entry) => $entry->company->corporate_reason)
            ->addColumn('status', fn($entry) => $entry->status == true ? 'ATIVO': 'INATIVO')
            ->addColumn('created_at_formatted', fn ($entry) => Carbon::parse($entry->created_at)->format('d/m/Y'));
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
            Column::make('Nome', 'name')->searchable()->sortable(),
            Column::make('E-mail', 'email')->searchable()->sortable(),
            Column::make('Telefone', 'number_phone')->searchable()->sortable(),
            Column::make('Data de Aniverário', 'birthday_at_formatted')->searchable()->sortable(),
            Column::make('Empresa', 'company')->searchable()->sortable(),
            Column::make('Status', 'status')->searchable()->sortable(),
            Column::make('Created', 'created_at_formatted'),
        ];
    }
    public function actions(): array
    {
        return [
            Button::add('button-update')
            ->render(function (User $user) {
                return Blade::render(<<<HTML
                <x-button-update primary icon="pencil" onclick="Livewire.emit('openModal', 'users.update', {{ json_encode(['user' => $user->id]) }})" />
                HTML);
            }),
            Button::add('button-change-password')
            ->render(function (User $user) {
                return Blade::render(<<<HTML
                <x-button-change-password primary icon="pencil" onclick="Livewire.emit('openModal', 'users.update-password', {{ json_encode(['user' => $user->id]) }})" />
                HTML);
            }),
            Button::add('button-address')
            ->render(function (User $user) {
                return Blade::render(<<<HTML
                <x-button-address primary icon="pencil" onclick="Livewire.emit('openModal', 'users.create-address', {{ json_encode(['user' => $user->id]) }})" />
                HTML);
            }),
            Button::add('button-trash')
            ->render(function (User $user) {
                return Blade::render(<<<HTML
                <x-button-trash primary icon="pencil" onclick="Livewire.emit('openModal', 'users.delete', {{ json_encode(['user' => $user->id]) }})" />
                HTML);
            }),
        ];
    }
}
