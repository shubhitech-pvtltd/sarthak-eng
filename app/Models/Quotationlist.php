<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotationlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id',
        'part_id',
        'price',
        'quantity',
        'discount',
        'discount_percent',
        'total',
        'unit',
        'created_by',
        'updated_by',
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function part()
    {
        return $this->belongsTo(Spare::class);
    }
}
