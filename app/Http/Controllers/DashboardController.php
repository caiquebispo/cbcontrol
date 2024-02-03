<?php

namespace App\Http\Controllers;

use App\Class\App\Dashboard;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('dashboard');
    }

    protected function getDataGraphSales(Request $request): ?array
    {
        return (new Dashboard)->getDataGraphSales($request->start, $request->end);
    }

    protected function getDataGraphAccess(Request $request): ?array
    {
        return (new Dashboard)->getDataGraphAccess($request->start, $request->end);
    }

    protected function getDataTableSales(Request $request): ?array
    {
        return (new Dashboard)->getDataTableSales($request->start, $request->end);
    }

    protected function getDataGraphSalesForCategories(Request $request): ?array
    {
        return (new Dashboard)->getDataGraphSalesForCategories($request->start, $request->end);
    }

    protected function getDataTableSalesForCategories(Request $request): ?array
    {
        return (new Dashboard)->getDataTableSalesForCategories($request->start, $request->end);
    }

    protected function getDataIndicators(Request $request): ?array
    {
        return (new Dashboard)->getDataIndicators($request->start, $request->end);
    }
}
