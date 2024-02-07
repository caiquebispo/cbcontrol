<?php

namespace App\Http\Livewire\Products;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use MBarlow\Megaphone\Types\General;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;

    public ?User $user;

    public ?string $name = null;

    public ?string $description = null;

    public ?int $category_id = null;

    public ?float $price = null;

    public ?int $quantity = null;

    public ?bool $showModal = false;

    protected array $rules = [

        'name' => 'required|min:4|max:150',
        'description' => 'nullable|string',
        'category_id' => 'required',
        'price' => 'required',
        'quantity' => 'required|min:1',

    ];

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function render(): View
    {
        return view('livewire.products.create', ['categories' => $this->user->company->categories]);
    }

    public function create(): void
    {

        $validated = $this->validate();

        $this->user->company->products()->create($validated);
        $this->notifications();
        $this->reset();
        $this->emit('products::index::created');
    }

    public function notifications(): void
    {

        $this->notification()->success(
            'Parabéns!',
            'Produto Cadastrado com sucesso!'
        );
        foreach ($this->user->company->users as $user) {

            $notification = new General(
                'Cadastro de Produto!',
                'O usuário(a) '.$this->user->name.' cadastrou um novo produto na empresa '.$this->user->company->corporate_reason, // Notification Body

            );
            $user->notify($notification);
        }
    }
}
