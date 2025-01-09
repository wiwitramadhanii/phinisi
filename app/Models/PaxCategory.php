<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaxCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'pax_range',
        'price_per_pax',
    ];

    // Relasi ke model Package
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function paxCategories()
    {
        return $this->hasMany(PaxCategory::class);
    }
}
