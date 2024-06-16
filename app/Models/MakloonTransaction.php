<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakloonTransaction extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'makloon_id',
        'payment_method_id',
        'amount',
        'description',
        'date',
        'created_by',
        'updated_by',
    ];

    public function makloon()
    {
        return $this->belongsTo(Makloon::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
