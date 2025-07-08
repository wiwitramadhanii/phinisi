<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_name',
        'image',
        'route',
        'time',
        'pax',
        'min_price',
        'include',
        'exclude',
        'rundown',
    ];

    protected $casts = [
        'include' => 'array',
        'exclude' => 'array',
        'rundown' => 'array',
    ];

    public function paxOptions()
    {
        return $this->hasMany(PaxCategory::class, 'package_id');
    }

    public function paxCategories()
    {
        return $this->hasMany(PaxCategory::class, 'package_id');
    }

    public function documentations()
    {
        return $this->hasMany(Documentation::class);
    }

}
