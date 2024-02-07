<?php

namespace App\Http\Controllers;

use App\Class\App\Sales;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use PDF;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('sales.index');
    }

    protected function getDataGraphPizza(Request $request): array
    {

        return [
            'chart_status' => (new Sales($request->start, $request->end))->getDataGraph('pizza', 'status'),
            'chart_segment' => (new Sales($request->start, $request->end))->getDataGraph('pizza', 'segment'),
            'chart_categories' => (new Sales($request->start, $request->end))->getDataGraph('pizza', 'categories'),
            'chart_products' => (new Sales($request->start, $request->end))->getDataGraph('pizza', 'products'),
            'chart_line_or_bar' => (new Sales($request->start, $request->end))->getDataGraph(),
        ];
    }

    protected function getDataResumeTableSales(Request $request): array|object
    {
        return (new Sales($request->start, $request->end))->getDataTableSales();
    }

    public static function export()
    {

        $summary = (new Sales(now()->format('Y-m-d'), now()->format('Y-m-d')))->getSummarySales();
        $pdf = PDF::loadView('boxfront.export.rds', compact('summary'));
        $fileName = 'RDS - Resumo de Vendas.pdf';
        $pdf->save(storage_path('/app/pdf/'.$fileName));

        return response()->download(storage_path('/app/pdf/'.$fileName));
    }
}
