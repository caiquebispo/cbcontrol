<?php

namespace App\Http\Livewire\Products;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use MBarlow\Megaphone\Types\General;
use WireUi\Traits\Actions;

class UpdateOrInsertPhoto extends Component
{
    use Actions;

    public ?object $product;

    public ?bool $showModal = false;

    use WithFileUploads;

    public $photos = [];

    protected array $rules = [

        'photos.*' => 'required|image|max:1024',
    ];

    public function render(): View
    {
        return view('livewire.products.update-or-insert-photo');
    }

    public function save(): void
    {
        $this->validate();

        foreach ($this->photos as $img) {

            $filename = str_replace(' ', '', date('YmdHi').$img->getClientOriginalName());
            $imagePath = $img->storeAs('public/images/product', $filename);
            $this->product->image()->create(['images_id' => $this->product->id, 'path' => $imagePath]);
        }

        $this->emitTo(ListPhotos::class, 'products::index::created');
        $this->notifications(count($this->photos));
    }

    public function notifications($totalImages): void
    {

        $this->notification()->success(
            'Parabéns!',
            'Imagem adicionada com sucesso!'
        );
        foreach (Auth::user()->company->users as $user) {

            $notification = new General(
                'Atualização de Produto!',
                'O usuário(a) '.Auth::user()->name.' adicionou '.$totalImages.' imagens á ao produto '.$this->product->name.' na empresa '.Auth::user()->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
