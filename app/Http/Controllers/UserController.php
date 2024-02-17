<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getAll(Request $request): Collection
    {
        return Auth()->user()->company->users()
            ->select('users.id', 'users.name')
            ->orderBy('name')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('users.name', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(10)
            )
            ->get();
    }
    public function index(): View
    {

        return view('users.index');
    }
}
