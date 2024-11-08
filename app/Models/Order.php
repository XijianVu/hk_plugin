<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Helpers\Functions;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'wp_orders';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'domain_data',
    ];

    public static function newDefault()
    {
        $order = new self();
        
        return $order;
    }

    public function saveFromRequest($request)
    {
        $this->fill($request->only(['name', 'phone', 'email']));

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'email' => 'required|email|max:255',
            'price' => 'required',
        ], [
            'name.required' => 'The name field is required.',
            'phone.required' => 'The phone field is required.',
            'email.required' => 'The email field is required.',
            'price.required' => 'The price field is required.',
        ]);

        $validator->after(function ($validator) use ($request) {
            $price = Functions::convertStringPriceToNumber($request->price);

            if ($price <= 0) {
                $validator->errors()->add('price', "Price must be greater than 0!");
            }
        });

        if ($validator->fails()) {
            return $validator->errors();
        }

        $price = Functions::convertStringPriceToNumber($request->price);

        $domainData = json_encode([
            'name' => $request->input('name'),
            'price' => $price,
        ]);

        $this->domain_data = $domainData;

        $this->save();

        return $validator->errors();
    }
}
