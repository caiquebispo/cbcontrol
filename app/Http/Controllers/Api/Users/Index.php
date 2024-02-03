<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Index extends Controller
{

    public function getCompanies(User $user, Request $request): Collection
    {
        return Company::query()
            ->whereIn('id', array_column($user->companies->toArray(), 'id'))
            ->select('id', 'corporate_reason',)
            ->orderBy('corporate_reason')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('corporate_reason', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(10)
            )
            ->get();
    }
}
