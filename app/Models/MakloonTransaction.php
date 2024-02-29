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
        'user_id',
        'amount',
        'description',
        'date',
    ];

    public function makloon()
    {
        return $this->belongsTo(Makloon::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
