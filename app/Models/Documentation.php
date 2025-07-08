<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'file_path',
    ];

    protected $casts = [
        'file_path' => 'array',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
