<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BoxFrontController extends Controller
{
    public function index(): View
    {
        return view('boxfront.index');
    }
}
