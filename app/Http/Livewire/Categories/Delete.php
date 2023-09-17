<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use MBarlow\Megaphone\Types\Important;
use WireUi\Traits\Actions;

class Delete extends Component
{
    use Actions;
    public ?Category $category;
    public ?User $user;
    public ?bool $showModal = false;

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
        $this->emitTo(ListCategories::class, 'categories::index::deleted');

    }
    public function notifications() :void
    {

        $this->notification()->success(
        'Parabéns!',
        'Categoria Deletado com sucesso!'
        );
        foreach($this->user->company->users as $user){

            $notification = new Important(
                'Remoção de Categoria!',
                'O usuário(a) '.$this->user->name.' deletou uma categoria na empresa '.$this->user->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
