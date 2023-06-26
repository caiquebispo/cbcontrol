<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class UpdateOrInsertPhoto extends ModalComponent
{
    use Actions;
    public User $user;
    public Product $product;
    use WithFileUploads;
 
    public $photos = [];

    protected $rules = [
        
        'photos.*' => 'required|image|max:1024'
    ];
    
    public function __construct()
    {
        $this->user = Auth::user();
        $this->product = new Product;
    }
    public function render(): View
    {
        return view('livewire.products.update-or-insert-photo');
    }

    public function save()
    {
        $this->validate();
        
        foreach ($this->photos as $img) {
            
            $filename = str_replace(" ", "", date('YmdHi').$img->getClientOriginalName());
            $imagePath = $img->storeAs('public/images/product', $filename);
            $this->product->image()->create(['images_id' => $this->product->id, 'path' => $imagePath]);
        }
        $this->emitTo(ListPhotos::class, 'products::index::created');
        $this->notifications(sizeof($this->photos));
    }
    public function notifications($totalImages):void
    {

        $this->notification()->success(
            $title = 'Parabéns!',
            $description =  'Imagem adicionada com sucesso!'
        ); 
        foreach(Auth::user()->company->users as $user){
            
            $notification = new \MBarlow\Megaphone\Types\General(
                'Atualização de Produto!',
                'O usuário(a) '.Auth::user()->name.' adicionou '.$totalImages.' imagens á ao produto '.$this->product->name.' na empresa '.$this->user->company->corporate_reason,
                
            );
            $user->notify($notification);
        }
    }
}
