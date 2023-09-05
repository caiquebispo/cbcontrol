<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(): View
    {
        return view('clients');
    }
    public static function exportPDF(){

        $clients  = Auth::user()->company->clients()->orderBy('clients.full_name','asc')->get();
        $pdf = PDF::loadView('clients.export.list_clients', compact('clients'));

        return $pdf->download('clients-details.pdf');
    }
}
