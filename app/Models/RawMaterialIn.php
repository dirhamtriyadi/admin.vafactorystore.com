<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterialIn extends Model
{
    use HasFactory;

    protected $table = 'raw_materials_in';

    protected $fillable = [
        'raw_material_id',
        'qty',
        'date',
        'description',
        'created_by',
        'updated_by',
    ];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
