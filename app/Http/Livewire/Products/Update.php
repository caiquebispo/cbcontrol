<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Update extends ModalComponent
{   
    use Actions;
    public User $user;
    public Product $product;
    public ?string $name = null;
    public ?string $description = null;
    public ?int $category_id = null;
    public ?float $price = null;
    public ?int $quantity = null;

    protected $rules = [

        'product.name' => 'required|min:4|max:150',
        'product.description' => 'nullable|string',
        'product.category_id' => 'required',
        'product.price' => 'required',
        'product.quantity' => 'required|min:1',

    ];
    public function __construct()
    {
        $this->user = Auth::user();
        $this->product = new Product;
    }
    public function render(): View
    {
        return view('livewire.products.update', ['categories' => $this->user->company->categories]);
    }
    public function update(): void
    {
        $this->validate();
        $this->product->save();
        $this->notifications(); 
        $this->reset();
        $this->emitTo(ListProducts::class, 'products::index::updated');
        $this->closeModal();
    }
    public function notifications(){

        $this->notification()->success(
            $title = 'Parabéns!',
            $description =  'Produto Editado com sucesso!'
        ); 
        foreach($this->user->company->users as $user){
            
            $notification = new \MBarlow\Megaphone\Types\General(
                'Atualização de Produto!',
                'O usuário(a) '.$this->user->name.' editou as informações de um Produto na empresa '.$this->user->company->corporate_reason,
                
            );
            $user->notify($notification);
        }
    }
}
