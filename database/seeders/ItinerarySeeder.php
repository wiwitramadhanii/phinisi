<?php

namespace Database\Seeders;

use App\Models\Itinerary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItinerarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Itinerary::create([
            'subtitle' => 'Gathering',
            'image' => 'itineraries/gathering.jpeg', // Pastikan file ini ada di storage/public/itineraries
        ]);
    }
}
