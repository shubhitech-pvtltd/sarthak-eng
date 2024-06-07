<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spare extends Model
{
    protected $fillable = [
        'machine_id',
        'part_no',
        'description',
        'purchase_form',
        'buying_price',
        'selling_price',
        'drawing_upload',
        'gea_selling_price',
        'unit',
        'hsn_code',
        'currency',
        'dimension',
    ];
}
