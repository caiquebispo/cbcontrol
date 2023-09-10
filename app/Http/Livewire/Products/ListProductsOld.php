<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
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

final class ListProductsOld extends PowerGridComponent
{
    use ActionButton;
    public Product $product;
    public User $user;

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'products::index::created' => '$refresh',
                'products::index::deleted' => '$refresh',
                'products::index::updated' => '$refresh',
            ]
        );
    }
    public function boot()
    {
        $this->user = Auth::user();
    }
    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function datasource(): ?Collection
    {
        return $this->user->company->products;
    }
    public function header(): array
    {
        return [
            Button::add('view')
                ->caption('Cadastrar Produto')
                ->class('inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150')
                ->openModal('products.create', []),

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
            ->addColumn('category', fn($entry) => $entry->categories->name)
            ->addColumn('price', fn($entry) => "R$ ".number_format($entry->price,'2',',','.'))
            ->addColumn('quantity')
            ->addColumn('status', fn($entry) => $entry->status == true ? 'ATIVO': 'INATIVO')
            ->addColumn('created_at_formatted', function ($entry) {
                return Carbon::parse($entry->created_at)->format('d/m/Y');
            });
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
            Column::make('Categoria', 'category')->searchable()->sortable(),
            Column::make('Preço', 'price')->sortable(),
            Column::make('Quantidade', 'quantity')->sortable(),
            Column::make('Status', 'status')->sortable(),
            Column::make('Created', 'created_at_formatted'),
        ];
    }
    public function actions(): array
    {
        return [

            Button::add('button-trash')
            ->render(function (Product $product) {
                return Blade::render(<<<HTML
                <x-button-trash primary icon="pencil" onclick="Livewire.emit('openModal', 'products.delete', {{ json_encode(['product' => $product->id]) }})" />
                HTML);
            }),
            Button::add('button-update')
            ->render(function (Product $product) {
                return Blade::render(<<<HTML
                <x-button-update primary icon="pencil" onclick="Livewire.emit('openModal', 'products.update', {{ json_encode(['product' => $product->id]) }})" />
                HTML);
            }),
            Button::add('button-add-photo')
            ->render(function (Product $product) {
                return Blade::render(<<<HTML
                <x-button-add-photo primary icon="pencil" onclick="Livewire.emit('openModal', 'products.update-or-insert-photo', {{ json_encode(['product' => $product->id]) }})" />
                HTML);
            }),
        ];
    }
}
