<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakloonDetail extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'makloon_id',
        'name',
        'code',
        'qty',
        'price',
        'size',
        'unit',
        'description',
    ];

    public function makloon()
    {
        return $this->belongsTo(Makloon::class);
    }
}
