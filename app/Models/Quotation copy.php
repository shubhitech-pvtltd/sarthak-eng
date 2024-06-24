<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

  
protected $fillable = [
    'customer_id', 
    'title',
    'description',
    'total' , 
    'created_by',
    'updated_by'
];

public function quotationlist(){
    return $this->hasMany(Quotationlist::class);
}

}