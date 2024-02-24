<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makloon extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'makloon_number',
        'user_id',
        'customer_id',
        'name',
        'description',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function details()
    {
        return $this->hasMany(MakloonDetail::class);
    }
}
