<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Availablestock extends Model
{
    protected $fillable = [
        'machine_id', 'part_id', 'minimum_stock_alert', 'quantity', 'created_by',
        'updated_by',
    ];

    public function part()
    {
        return $this->belongsTo(Spare::class, 'part_id');
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id');
    }
}

