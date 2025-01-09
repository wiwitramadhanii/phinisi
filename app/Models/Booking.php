<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'package_name',
        'name',
        'email',
        'phone',
        'selected_date',
        'time',
        'pax_category',
        'num_pax',
        'total_price',
    ];

    public function bookings()
    {   
        return $this->hasMany(Booking::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function paxCategory()
    {
        return $this->belongsTo(PaxCategory::class);
    }
}
