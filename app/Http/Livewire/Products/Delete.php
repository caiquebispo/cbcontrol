<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use MBarlow\Megaphone\Types\Important;
use WireUi\Traits\Actions;

class Delete extends Component
{
    use Actions;
    public ?User $user;
    public ?Product $product;
    public ?bool $showModal = false;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->product = new Product;
    }

    public function render(): View
    {
        return view('livewire.products.delete');
    }
    public function delete():void
    {
        $this->deletePhotos($this->product->image);
        $this->product->delete();
        $this->notifications();
        $this->emit('products::index::deleted');
    }
    public function deletePhotos($images): void
    {

        foreach($images as $image){
            Storage::delete($image->path);
            $image->delete();
        }

    }
    public function notifications(): void
    {

        $this->notification()->success(
            'Parabéns!',
            'Produto Deletado com sucesso!'
        );
        foreach($this->user->company->users as $user){

            $notification = new Important(
                'Remoção de Produto!',
                'O usuário(a) '.$this->user->name.' deletou um produto na empresa '.$this->user->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
