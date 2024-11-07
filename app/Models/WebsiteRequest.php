<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class WebsiteRequest extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
    ];

    public static function newDefault()
    {
        $websiteRequest = new self();
        return $websiteRequest;
    }

    public function saveFromRequest($request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);
    
        $this->fill($validatedData);
        $this->save();
    
        return null;
    }
}
