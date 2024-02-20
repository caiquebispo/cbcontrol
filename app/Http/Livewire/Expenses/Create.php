<?php

namespace App\Http\Livewire\Expenses;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use MBarlow\Megaphone\Types\General;
use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;
    public ?bool $showModal = false;
    public ?string $name = null;
    public ?float $value = null;
    public ?int $quantity = 1;
    public ?object $user = null;

    protected array $rules = [

        'name' => 'required|min:4|max:150',
        'value' => 'required',
        'quantity' => 'required|min:1',

    ];
    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function create(): void
    {

        $validated = $this->validate();

        $this->user->company->expenses()->create(
            array_merge(
                $validated,
                [
                    'user_id' => $this->user->id,
                    'day' => now()->format('Y-m-d')
                ]
            )
        );
        $this->notifications();
        $this->reset();
    }

    public function notifications(): void
    {

        $this->notification()->success(
            'Parabéns!',
            'Despesa Cadastrado com sucesso!'
        );
        foreach ($this->user->company->users as $user) {

            $notification = new General(
                'Cadastro de Produto!',
                'O usuário(a) ' . $this->user->name . ' cadastrou um novo despesa na empresa ' . $this->user->company->corporate_reason, // Notification Body

            );
            $user->notify($notification);
        }
    }
    public function render(): View
    {
        return view('livewire.expenses.create');
    }
}
