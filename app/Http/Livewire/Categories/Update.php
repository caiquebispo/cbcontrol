<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Update extends ModalComponent
{
    use Actions;
    public Category $category;
    public User $user;

    public ?string $name = null;

    protected $rules = [

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
        $this->emitTo(ListCategoriesOld::class, 'categories::index::updated');
        $this->closeModal();
    }
    public function notifications(): void
    {

        $this->notification()->success(
            $title = 'Parabéns!',
            $description =  'Categoria Editado com sucesso!'
        );
        foreach($this->user->company->users as $user){

            $notification = new \MBarlow\Megaphone\Types\General(
                'Atualização de Categoria!',
                'O usuário(a) '.$this->user->name.' editou as informações de uma categoria na empresa '.$this->user->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
