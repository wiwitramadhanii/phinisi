<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Data dummy, bisa diganti dengan model/database
        $company = [
            'name' => 'Pinisi Hakata',
            'logo' => 'frontend/img/phinisi/logo-header.png',
            'banner' => 'frontend/img/phinisi/bannerphinisi.jpg',
            'about' => 'Pinisi Hakata adalah perusahaan penyedia paket wisata kapal tradisional Pinisi dengan layanan profesional dan pengalaman tak terlupakan di perairan Sulawesi Selatan.',
            'vision' => 'Menjadi pelopor wisata bahari berbasis tradisi Indonesia yang unggul dan berkelanjutan.',
            'mission' => [
                'Menyuguhkan pengalaman wisata laut autentik dengan kapal Pinisi.',
                'Memberdayakan masyarakat lokal melalui pariwisata berkelanjutan.',
                'Menjaga kelestarian budaya maritim Indonesia.',
            ],
            'values' => [
                'Keamanan & Keselamatan',
                'Pelayanan Prima',
                'Keaslian Budaya',
                'Ramah Lingkungan',
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
