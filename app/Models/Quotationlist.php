<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Quotationlist extends Model
{
    use HasFactory;

protected $fillable = [
    'quotation_id', 
    'machine_id',
    'part_id', 
    'price',
    'quantity', 
    'discount',
    'discount_percent',
    'currency',
    'created_by',
    'updated_by'
];

public function quotation(){

    return $this->belongsTo(Quotation::class);
    
}

}