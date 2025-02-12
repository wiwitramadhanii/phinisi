<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah user sudah ada sebelum membuatnya
        if (!User::where('email', 'wiwitramadani@gmail.com')->exists()) {
            User::create([
                'name' => 'Wiwit Ramadhani',
                'email' => 'wiwitramadani@gmail.com',
                'password' => Hash::make('password123'), // Gunakan password yang lebih kuat
            ]);
        }
    }
}
