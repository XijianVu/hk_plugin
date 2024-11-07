<?php

namespace App\Http\Controllers\Hk;

use App\Http\Controllers\Controller;
use App\Models\WebsiteRequest;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('hk.main.index', [
            
        ]);
    }

    public function store(Request $request)
    {
        $websiteRequest = WebsiteRequest::newDefault();
    
        $errors = $websiteRequest->saveFromRequest($request);

        if (!empty($errors)) {
            return response()->view('hk.main.index', [
                'websiteRequest' => $websiteRequest,
                'errors' => $errors,
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Đã thêm account thành công',
        ]);
    }
    
    
}
