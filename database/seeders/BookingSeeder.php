<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Package;
use App\Models\PaxCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua package dan pax category
        $packages     = Package::all();
        $paxCategories = PaxCategory::all();

        if ($packages->isEmpty() || $paxCategories->isEmpty()) {
            $this->command->warn('Seeder Booking: Pastikan ada data di tabel packages dan pax_categories terlebih dahulu.');
            return;
        }

        // Hapus dulu (opsional)
        DB::table('bookings')->truncate();

        // Buat 10 contoh booking
        for ($i = 1; $i <= 3; $i++) {
            $package    = $packages->random();
            $paxCat     = $paxCategories->random();
            // generate jumlah pax antara min dan max kategori
            [$min, $max] = explode('-', $paxCat->pax_range);
            $numPax     = rand((int)$min, (int)$max);
            $date       = Carbon::today()->addDays(rand(1, 60))->format('Y-m-d');

            Booking::create([
                'package_id'    => $package->id,
                'name'          => fake()->name(),
                'email'         => fake()->unique()->safeEmail(),
                'phone'         => fake()->phoneNumber(),
                'selected_date' => $date,
                'pax_category'  => $paxCat->pax_range,
                'num_pax'       => $numPax,
                'total_price'   => $paxCat->price_per_pax * $numPax,
                'is_already_pay' => 0,
            ]);
        }

        $this->command->info('Seeder Booking: 3 record berhasil dibuat.');
    }
}
