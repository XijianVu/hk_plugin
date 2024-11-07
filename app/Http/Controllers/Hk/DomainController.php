<?php

namespace App\Http\Controllers\hk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Functions;

class DomainController extends Controller
{
    public function index(Request $request)
    {
        return view('hk.domain.index');
    }

    public function searchDomain(Request $request)
    {
        // Trimming và kiểm tra tên miền
        $domain = trim($request->input('value'));
    
        if (!Functions::isValidDomainFormat($domain)) {
            return response()->json([
                'message' => "Tên miền chưa hợp lệ!",
                'status' => 400
            ], 400);
        }
    
        $isDomainAvailable = Functions::isDomainAvailable($domain);
    
        if (!$isDomainAvailable) {
            return response()->json([
                'message' => "Domain đã tồn tại!",
                'status' => 409 // Conflict
            ], 409);
        }
    
        return response()->json([
            'message' => "Domain hợp lệ!",
            'status' => 200
        ], 200);
    }

    public function suggestDomain(Request $request) 
    {
        $searchValue = $request->searchValue;
        $suggestDomains = Functions::getSuggestDomains($searchValue);

        return response()->view('hk.domain.suggest_domains', [
            'domains' => $suggestDomains
        ], 200);
    }

    public function registerForm(Request $requst)
    {
        return view('hk.domain.register');
    }
}
