<?php

namespace App\Http\Livewire\Products;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use WireUi\Traits\Actions;

class DeletePhoto extends Component
{
    use Actions;

    public Image $img;

    public function __construct()
    {
        $this->img = new Image;
    }

    public function render()
    {
        return view('livewire.products.delete-photo');
    }

    public function delete()
    {

        Storage::delete($this->img->path);
        $this->img->delete();
        $this->notifications();
        $this->emitTo(ListPhotos::class, 'products::index::deleted');

    }

    public function notifications()
    {

        $this->notification()->success(
            $title = 'Parabéns!',
            $description = 'Imagem Deletado com sucesso!'
        );
        foreach (Auth::user()->company->users as $user) {

            $notification = new \MBarlow\Megaphone\Types\Important(
                'Remoção de Imagem de Produto!',
                'O usuário(a) '.Auth::user()->name.' a  imagem de um produto na empresa '.Auth::user()->company->corporate_reason,

            );
            $user->notify($notification);
        }
    }
}
