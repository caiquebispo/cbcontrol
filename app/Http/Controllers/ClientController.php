<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
        return view('clients.index');
    }
    public function caroline(): View
    {
        return view('clients.caroline');
    }
    public function getAll(Request $request): Collection
    {
        return Auth()->user()->company->clients()
            ->select('clients.id', 'clients.full_name')
            ->orderBy('full_name')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('clients.full_name', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(10)
            )
            ->get();
    }
    public static function exportPDF()
    {

        $clients = Auth::user()->company->clients()->orderBy('clients.full_name', 'asc')->get();
        $pdf = PDF::loadView('clients.export.list_clients', compact('clients'));
        $fileName = 'Listagem de cliente ' . (new Datetime('now'))->format('d-m-Y H_i_s') . '.pdf';
        $pdf->save(storage_path('/app/pdf/' . $fileName));

        return response()->download(storage_path('/app/pdf/' . $fileName));
    }
}
