<?php

namespace App\Http\Controllers\hk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Functions;
use App\Models\Order;
use App\Services\Domain\Domain;

class DomainController extends Controller
{
    public function index(Request $request)
    {
        return view('hk.domain.index');
    }

    public function searchDomain(Request $request)
    {
        $domainName = trim($request->input('value'));
        $domain = Domain::newDefault($domainName);
    
        if (!$domain->isValidNameFormat()) {
            return response()->json([
                'message' => "Tên miền chưa hợp lệ!",
                'status' => 400
            ], 400);
        }
    
        if (!$domain->isAvailable()) {
            return response()->json([
                'message' => "Domain đã tồn tại!",
                'status' => 409 // Conflict
            ], 409);
        }
    
        return response()->json([
            'message' => "Domain hợp lệ!",
            'domain' => $domain,
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

    public function saveOrder(Request $request)
    {
        $order = Order::newDefault();
        $errors = $order->saveFromRequest($request);

        if (!$errors->isEmpty()) {
            return response()->json([
                'status' => 400,
                'message' => "Save order fail!",
                'errors' => $errors
            ], 400);
        }

        return response()->json([
            'status' => 200,
            'message' => "Save order successfully!",
        ], 200);
    }

    public function registerForm(Request $requst)
    {
        return view('hk.domain.register');
    }
}
