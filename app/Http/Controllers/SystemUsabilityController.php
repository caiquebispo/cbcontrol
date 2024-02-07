<?php

namespace App\Http\Controllers;

use App\Class\App\SystemUsability;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SystemUsabilityController extends Controller
{
    public function index(): View
    {
        return view('systemUsability.index');
    }

    public function getDataTable(Request $request)
    {
        return (new SystemUsability($request->start, $request->end))->getDataTable();
    }

    public function getDataGraphs(Request $request)
    {
        return (new SystemUsability($request->start, $request->end))->getDataGraphs();
    }
}
