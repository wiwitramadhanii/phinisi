<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaxCategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('pax_categories')->insert([
            [
                'package_id' => 1,
                'pax_range' => '10-14',
                'price_per_pax' => 529000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 1,
                'pax_range' => '15-19',
                'price_per_pax' => 399000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 1,
                'pax_range' => '20-24',
                'price_per_pax' => 349000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 1,
                'pax_range' => '25-50',
                'price_per_pax' => 279000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 2,
                'pax_range' => '10-14',
                'price_per_pax' => 599000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 2,
                'pax_range' => '15-19',
                'price_per_pax' => 490000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 2,
                'pax_range' => '20-24',
                'price_per_pax' => 419000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 2,
                'pax_range' => '25-50',
                'price_per_pax' => 379000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 3,
                'pax_range' => '10-14',
                'price_per_pax' => 1090000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 3,
                'pax_range' => '15-19',
                'price_per_pax' => 790000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 3,
                'pax_range' => '20-24',
                'price_per_pax' => 690000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 3,
                'pax_range' => '25-50',
                'price_per_pax' => 590000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 4,
                'pax_range' => '10-14',
                'price_per_pax' => 479000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 4,
                'pax_range' => '15-19',
                'price_per_pax' => 359000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 4,
                'pax_range' => '20-24',
                'price_per_pax' => 309000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 4,
                'pax_range' => '25-50',
                'price_per_pax' => 249000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
