<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $company = [
            'name' => 'Pinisi Hakata',
            'logo' => 'frontend/img/phinisi/logo-header.png',
            'banner' => 'frontend/img/phinisi/bannerphinisi.jpg',
            'about' => 'Pinisi Hakata merupakan penyedia layanan wisata bahari eksklusif dengan menggunakan kapal Pinisi tradisional khas Sulawesi Selatan. Berbasis di Makassar, kami menggabungkan warisan budaya maritim Bugis-Makassar dengan pelayanan modern untuk menghadirkan pengalaman pelayaran yang tak terlupakan di perairan Indonesia Timur, khususnya kepulauan Spermonde dan sekitarnya untuk wisatawan domestik maupun mancanegara.',
            'vision' => 'Menjadi pelopor wisata bahari berbasis budaya di Indonesia dengan menghadirkan kapal Pinisi sebagai ikon kebanggaan maritim nasional.',
            'mission' => [
                'Menawarkan layanan wisata bahari premium dengan standar keamanan dan kenyamanan tinggi.',
                'Mempromosikan kapal Pinisi sebagai warisan budaya dunia kepada wisatawan domestik dan mancanegara.',
                'Mendukung pemberdayaan ekonomi masyarakat pesisir melalui pariwisata.',
            ],
            'values' => [
                'Kru Ramah & Berpengalaman',
                'Standar keselamatan tinggi & Asuransi wisatawan',
                'Paket fleksibel dan bisa disesuaikan',
            ],
            'contact' => [
                'address' => 'Anjungan Pantai Losari, Makassar, Sulawesi Selatan',
                'phone'   => '+62 811-1234-567',
                'email'   => 'info@pinisihakata.co.id',
            ],
        ];

        return view('profile', compact('company'));
    }
}
