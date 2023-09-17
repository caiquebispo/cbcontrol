<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use MBarlow\Megaphone\Types\General;
use WireUi\Traits\Actions;

class Update extends Component
{
    use Actions;
    public ?Category $category;
    public ?User $user;
    public ?string $name = null;
    public ?bool $showModal = false;

    protected array $rules = [

        'category.name' => 'required|min:4|max:150'
    ];
    public function __construct()
    {
        $this->category = new Category;
        $this->user = Auth::user();
    }
    public function render(): View
    {
        return view('livewire.categories.update');
    }
    public function update(): void
    {
        $this->validate();
        $this->category->save();
        $this->notifications();
        $this->reset();
        $this->emitTo(ListCategories::class, 'categories::index::updated');
    }
    public function notifications(): void
    {

        $this->notification()->success(
            'Parabéns!',
            'Categoria Editado com sucesso!'
        );
        foreach($this->user->company->users as $user){

            $notification = new General(
                'Atualização de Categoria!',
                'O usuário(a) '.$this->user->name.' editou as informações de uma categoria na empresa '.$this->user->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
