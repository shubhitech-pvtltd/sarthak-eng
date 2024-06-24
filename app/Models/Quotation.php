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
        'grand_total', 
        
    ];

    public function quotationlists()
    {
        return $this->hasMany(Quotationlist::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($quotation) {
            $quotation->quotationlists()->delete();
        });
    }
}


