<?php

namespace App\Http\Controllers\hk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HostingRequest;

class HostingController extends Controller
{
    public function index(Request $request)
    {
        return view('hk.hosting.index', [       
        ]);
    }
    public function store(Request $request)
    {
        HostingRequest::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'type' => $request->type,
        ]);
        
        return redirect()->back()->with('success', 'Yêu cầu của bạn đã được gửi thành công!');
    }
}
