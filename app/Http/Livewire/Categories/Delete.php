<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;
use LivewireUI\Modal\ModalComponent;
class Delete extends ModalComponent
{
    use Actions;
    public Category $category;
    public User $user;

    public function __construct()
    {
        $this->category = new Category;
        $this->user = Auth::user();
    }
    public function render(): View
    {
        return view('livewire.categories.delete');
    }
    public function delete():void
    {

        $this->category->delete();
        $this->notifications();
        $this->reset();
        $this->emitTo(ListCategoriesOld::class, 'categories::index::deleted');
        $this->closeModal();
    }
    public function notifications() :void
    {

        $this->notification()->success(
            $title = 'Parabéns!',
            $description =   'Categoria Deletado com sucesso!'
        );
        foreach($this->user->company->users as $user){

            $notification = new \MBarlow\Megaphone\Types\Important(
                'Remoção de Categoria!',
                'O usuário(a) '.$this->user->name.' deletou uma categoria na empresa '.$this->user->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
