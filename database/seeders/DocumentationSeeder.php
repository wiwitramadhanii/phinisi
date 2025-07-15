<?php

namespace Database\Seeders;

use App\Models\Documentation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('documentations')->insert([
            [
                'package_id' => 1,
                'file_path' => json_encode([
                    'documentations/ghc.png', 'documentations/ghc2.png', 'documentations/dinner.png', 'documentations/fireworks.png', 'documentations/ghc3.png'
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'package_id' => 2,
                'file_path' => json_encode([
                    'documentations/morning.png','documentations/fun games.png', 'documentations/snorkeling.png', 'documentations/lunch.png', 'documentations/morning2.png'
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'package_id' => 3,
                'file_path' => json_encode([
                    'documentations/fullday.png', 'documentations/outing.png', 'documentations/dinner.png', 'documentations/snorkeling.png', 'documentations/lunch.png'
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'package_id' => 4,
                'file_path' => json_encode([
                    'documentations/gsc.jpg', 'documentations/gsc2.png', 'documentations/coffee.png', 'documentations/breakfast.png', 'documentations/karaoke.png'
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
