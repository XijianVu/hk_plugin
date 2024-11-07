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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable|numeric|min:9',
        ]);
    
        $validator->after(function($validator) {
            if (self::relatedContactsByPhone($this->phone)->where('id', '!=', $this->id)->count()) {
                $validator->errors()->add("phone", "Số điện thoại đã được sử dụng. Vui lòng tìm chọn liên hệ/khách hàng đã có.");
            }
        });
    
        if ($validator->fails()) {
            return $validator->errors();
        }
    
        $this->fill($request->all());
    
        // Lưu đối tượng
        $this->save();
    
        return null;
    }

    public function scopeRelatedContactsByPhone($query, $phone)
    {
        $compareNumber = \App\Library\Tool::getLastNineNumberOfPhone($phone);

        if (empty($compareNumber)) {
            return $query->where('id', -1);
        }

        $query->active()
            ->where(function($q) use ($compareNumber) {
                $q->where('phone', 'LIKE', "%$compareNumber");
            });
    }
}
