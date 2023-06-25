<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Delete extends ModalComponent
{
    use Actions;
    public User $user;
    public Product $product;

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
        $this->emitTo(ListProducts::class, 'products::index::deleted');
        $this->closeModal();
    }
    public function deletePhotos($images): void
    {

        foreach($images as $image){
            Storage::delete($image->path);
            $image->delete();
        }
        
    }
    public function notifications(){

        $this->notification()->success(
            $title = 'Parabéns!',
            $description =   'Produto Deletado com sucesso!'
        ); 
        foreach($this->user->company->users as $user){
            
            $notification = new \MBarlow\Megaphone\Types\Important(
                'Remoção de Produto!',
                'O usuário(a) '.$this->user->name.' deletou um produto na empresa '.$this->user->company->corporate_reason,
                
            );
            $user->notify($notification);
        }
    }
}
