<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spare extends Model
{
    protected $fillable = [
        'machine_id',
        'part_no',
        'description',
        'purchase_from',
        'buying_price',
        'selling_price',
        'drawing_upload',
        'gea_selling_price',
        'unit',
        'hsn_code',
        'comment',
        'dimension',
        'quantity',
        'minimum_stock_alert',
        'created_by',
        'updated_by',
    ];

    public function incomingStocks()
    {
        return $this->hasMany(Incomingstock::class, 'part_id');
    }

    public function outgoingStocks()
    {
        return $this->hasMany(Outgoingstock::class, 'part_id');
    }
}
