<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('groups');
    }
    public function updateGroupsClients()
    {
        $related = DB::table('group_clients')->get();

        foreach ($related as $rl) {

            Client::find($rl->client_id)->update(['group_id' => $rl->group_id]);
        }
    }
}
