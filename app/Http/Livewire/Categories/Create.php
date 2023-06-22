<?php

namespace App\Http\Livewire\Categories;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;


class Create extends ModalComponent
{
    use Actions;
    public User $user;
    public ?string $name = null;

    protected $rules = [

        'name' => 'required|min:4|max:100'
    ];

    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function render(): View
    {
        return view('livewire.categories.create');
    }
    public function create(): void
    {
        $this->validate();
        $this->user->company->categories()->updateOrCreate(['categories_id' => $this->user->company->id, 'name' => $this->name] ,$this->validate());
        $this->reset();
        $this->notifications();
        $this->emitTo(ListCategories::class, 'categories::index::created');
        $this->closeModal();
    }

    public function notifications(): void
    {

        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Categoria Cadastrado com sucesso!'
        ); 
        foreach($this->user->company->users as $user){
            
            $notification = new \MBarlow\Megaphone\Types\General(
                'Cadastro de Categoria!',
                'O usuário(a) '.$this->user->name.' cadastrou uma nova categoria na empresa '.$this->user->company->corporate_reason,
                
            );
            $user->notify($notification);
        }
    }
}
