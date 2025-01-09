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
        'banner',
        'time',
        'route',
        'description',
        'min_price',
        'include',
        'exclude',
        'rundown',
        'status',
    ];

    protected $casts = [
        'include' => 'array',
        'exclude' => 'array',
        'rundown' => 'array',
    ];

    public function paxOptions()
    {
        return $this->hasMany(PaxCategory::class);
    }

}
