<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customerprice extends Model
{
    use HasFactory; 
    
   
    protected $table = 'customerprices';

    protected $fillable = [
        'machine_id',
        'part_id',
        'customer_id',
        'price',
        'buying_price',
        'discount',
        'discount_percent',
        'created_by',
        'updated_by',
    ];
}