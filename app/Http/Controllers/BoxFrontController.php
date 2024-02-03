<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class BoxFrontController extends Controller
{
    public function index(): View
    {
        return view('boxfront.index');
    }
}
