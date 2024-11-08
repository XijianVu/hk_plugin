<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostingRequest extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'type',
    ];
}
