<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'All',
                'image' => 'sliders/all.png',
            ],
            [
                'title' => 'golden hour cruise',
                'image' => 'sliders/ghc.png',
            ],
            [
                'title' => 'morning trip',
                'image' => 'sliders/morning.png',
            ],
            [
                'title' => 'Fullday Trip',
                'image' => 'sliders/fullday.png',
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
