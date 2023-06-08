<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
}
