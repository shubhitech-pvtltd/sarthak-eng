<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function quotations()
    {
        return $this->hasMany(Quotation::class, 'customer_id');
    }
}
