<?php

namespace Database\Seeders;

use App\Models\Itinerary;
use Illuminate\Database\Seeder;

class ItinerarySeeder extends Seeder
{
    public function run(): void
    {

        $itineraries = [
            [
                'subtitle' => 'Gathering',
                'image'    => 'itineraries/gathering.png',
            ],
            [
                'subtitle' => 'Outing',
                'image'    => 'itineraries/outing.png',
            ],
            [
                'subtitle' => 'Lunch',
                'image'    => 'itineraries/lunch.png',
            ],
            [
                'subtitle' => 'Snorkeling',
                'image'    => 'itineraries/snorkeling.png',
            ],
            [
                'subtitle' => 'Fun Games',
                'image'    => 'itineraries/fun games.png',
            ],
            [
                'subtitle' => 'Fireworks Celebrate & Dancing',
                'image'    => 'itineraries/fireworks celebrate.png',
            ],
            [
                'subtitle' => 'Dinner',
                'image'    => 'itineraries/dinner.png',
            ],
            [
                'subtitle' => 'Karaoke & Dancing Tome',
                'image'    => 'itineraries/karaoke.png',
            ],
            [
                'subtitle' => 'Breakfast on Board',
                'image'    => 'itineraries/Breakfast.png',
            ],

        ];

        foreach ($itineraries as $item) {
            Itinerary::create([
                'subtitle'   => $item['subtitle'],
                'image'      => $item['image'],
            ]);
        }
    }
}
