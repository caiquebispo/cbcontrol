<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\SettingCompany;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        
        $slug =  Str::slug(last(explode('/', parse_url($request->fullUrl(), PHP_URL_PATH))));
        $settingCompany = SettingCompany::where('slung', $slug)->first();

        if(empty($settingCompany)){

            return response()->json(['success' => false, 'message' => 'Empresa não encontrada', 'code' => 404],404);
        }
        $company = $settingCompany->company;
        return view('store.home.index', compact('company'));

    }
}
