<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Package::insert([
            [
                'package_name' => 'Golden Hours Cruise',
                'image' => 'packages/ghc.png',
                'time' => '17:00-20:00',
                'route' => 'Losari - Lae Lae Island',
                'pax' => '10-50',
                'min_price' => 279000,
                'include' => json_encode([
                    'Pick Up Service', 'Welcome Drink', 'Snack', 'Meals', 'Refill Mineral Water', 
                    'Luxury Private Room', 'Safety Insurance', 'MC & Crew', 'Photo & Video', 
                    'Sound System', 'Live Accoustic', 'Fireworks'
                ]),
                'exclude' => json_encode([
                    'Add. Destination', 'Add. Meals', 'Add. Decoration', 'Tipping Crew'
                ]),
                'rundown' => json_encode([
                    ['time' => '17:00', 'activity' => 'Welcome Greeting'],
                    ['time' => '17:20', 'activity' => 'Education Phinisi, Sunset Time with Hakata Accoustic'],
                    ['time' => '18:00', 'activity' => 'Magrib Time'],
                    ['time' => '18:30', 'activity' => 'Dinner Time'],
                    ['time' => '19:00', 'activity' => 'Fireworks Celebrate & Dancing'],
                    ['time' => '19:40', 'activity' => 'Sailing Back to Losari']
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'package_name' => 'Morning Samalona',
                'image' => 'packages/morning.png',
                'time' => '08:00-13:00',
                'route' => 'Losari - Samalona',
                'pax' => '10-50',
                'min_price' => 379000,
                'include' => json_encode([
                    'Pick Up Service', 'Welcome Drink', 'Snack', 'Standart Soundsystem', 'Seafood Meals Bbq',
                    'Free Refill Mineral Water', 'Luxury Private Room with AC', 'Free Video Creative (+1 Minutes Duration)', 
                    'MC & Crew', 'Photo & Video Crew', 'Snorkeling Gear 6 set at Samalona Island', 'Mini Games Instructor', 
                    'Life Jacket', 'First Aid Kit'
                ]),
                'exclude' => json_encode([
                    'Add. Tour', 'Add. Meals', 'Add. Decoration (Based on Request)', 'Tipping Crew'
                ]),
                'rundown' => json_encode([
                    ['time' => '08:00', 'activity' => 'Pick Up Service'],
                    ['time' => '08:15', 'activity' => 'Welcome Service'],
                    ['time' => '08:30', 'activity' => 'Welcome Greeting'],
                    ['time' => '08:45', 'activity' => 'On Board to Samalona'],
                    ['time' => '09:30', 'activity' => 'Welcome Greeting'],
                    ['time' => '10:00', 'activity' => 'Fun Games'],
                    ['time' => '10:30', 'activity' => 'Snorkeling'],
                    ['time' => '11:00', 'activity' => 'Lunch'],
                    ['time' => '12:00', 'activity' => 'Free Program'],
                    ['time' => '12:30', 'activity' => 'Sailing Back to Losari']
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'package_name' => 'Full Day Kodingareng',
                'image' => 'packages/fullday.png',
                'time' => '08:00-20:00',
                'route' => 'Losari - Kodingareng Keke',
                'pax' => '10-50',
                'min_price' => 590000,
                'include' => json_encode([
                    'Pick Up Service', 'Welcome Drink', 'Snack', 'Standart Soundsystem', 'Live Accoustic', 'Seafood Meals Bbq',
                    'Free Dessert', 'Free Flow Mineral Water', 'Luxury Private Room with AC', 'Free Video Creative (Min. 1-3 Duration)',
                    'SpeedBoat(Return Transfer)', 'Tour Leader & Crew', 'Photo & Video Crew', 
                    'Snorkeling Gear 6 set at Samalona/Kodingareng Keke', 'Standart Prasmanan', 'Mini Games Instructor', 
                    'Life Jacket', 'First Aid Kit', 'Fireworks'
                ]),
                'exclude' => json_encode([
                    'Add. Tour', 'Add. Meals', 'Add. Decoration (Based on Request)', 'Tipping Crew'
                ]),
                'rundown' => json_encode([
                    ['time' => '08:00', 'activity' => 'Keberangkatan dari dermaga menuju Pulau Kodingareng'],
                    ['time' => '10:00', 'activity' => 'Snorkeling dan eksplorasi bawah laut'],
                    ['time' => '12:00', 'activity' => 'Makan siang di pulau'],
                    ['time' => '14:00', 'activity' => 'Jelajah pantai dan berfoto'],
                    ['time' => '16:00', 'activity' => 'Kembali ke dermaga']
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
