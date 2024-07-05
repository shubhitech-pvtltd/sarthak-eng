<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
    protected $table = 'buyers';

    protected $fillable = [
        'buyer_name',
        'buyer_email',
        'buyer_phone_no',
        'buyer_aadhar_no',
        'buyer_address',
        'country',
        'state',
        'city',
        'pincode',
        'created_by',
        'updated_by',
    ];
}
