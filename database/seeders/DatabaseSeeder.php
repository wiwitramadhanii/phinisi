<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\DocumentationSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SliderSeeder::class,
            ItinerarySeeder::class,
            PackageSeeder::class,
            PaxCategorySeeder::class,
            BookingSeeder::class,
            DocumentationSeeder::class,
        ]);
    
    }
}
