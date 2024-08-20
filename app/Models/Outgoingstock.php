<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outgoingstock extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'rack_no',
        'carrot_no',
        'description',
        'machine_id',
        'part_id',
        'dwg_no',
        'quantity',
        'unit',
        'dimension',
        'outgoing',
        'stock_in_hand',
        'minimum_stock_alert',
        'purchasing_price',
        'total_purchasing',
        'selling_price',
        'total_selling_price',
        'export_selling_price',
        'gea_selling_price',
        'created_by',
        'updated_by',
    ];


    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }


    public function part()
    {
        return $this->belongsTo(Spare::class, 'part_id');
    }
}
