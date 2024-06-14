<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customerprice extends Model
{
    use HasFactory;  
    protected $fillable = [
        'machine_id',
        'part_id',
        'customer_id',
        'price',
        'discount',
        'discount_percent',
        'currency',
        'created_by',
        'updated_by',
    ];
}

