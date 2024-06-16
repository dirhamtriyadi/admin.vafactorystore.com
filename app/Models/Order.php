<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'order_number',
        'customer_id',
        'print_type_id',
        'qty',
        'price',
        'subtotal',
        'discount',
        'total',
        'name',
        'description',
        'date',
        'created_by',
        'updated_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function printType()
    {
        return $this->belongsTo(PrintType::class);
    }
}
