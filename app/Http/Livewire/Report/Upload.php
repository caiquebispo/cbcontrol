<?php

namespace App\Http\Livewire\Report;

use App\Imports\ClientsImport;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Upload extends Component
{
    use WithFileUploads;
    public $file;

    public function upload(): void
    {

        Excel::import(new ClientsImport, $this->file);
    }
    public function render(): View
    {
        return view('livewire.report.upload');
    }
}
